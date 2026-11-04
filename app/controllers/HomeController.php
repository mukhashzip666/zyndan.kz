<?php
/**
 * HomeController - Контроллер главной страницы
 */

require_once __DIR__ . '/../../core/Controller.php';

class HomeController extends Controller
{
    private $postModel;
    private $categoryModel;
    private $videoModel;
    private $adModel;

    public function __construct()
    {
        parent::__construct();
        $this->postModel = $this->model('PostModel');
        $this->categoryModel = $this->model('CategoryModel');
        $this->videoModel = $this->model('VideoModel');
        $this->adModel = $this->model('AdModel');
    }

    /**
     * Главная страница
     */
    public function index()
    {
        // Определяем текущий язык из URL
        $lang = $this->getLang();

        // Получаем данные для главной страницы
        $postModel = $this->model('PostModel');

        // Последние новости (увеличиваем лимит до 18)
        $latestNews = $postModel->getPublished($lang, 18, 0);

        // Hero новость - автоматически берем самую свежую (первую в списке)
        $heroPost = !empty($latestNews) ? $latestNews[0] : null;

        // Анонсы (is_announcement = 1)
        $announcements = $postModel->getAnnouncements($lang, 5);

        // Популярные новости
        $popularNews = $postModel->getPopular($lang, 4);

        // Получаем категории для навигации
        $categories = $this->categoryModel->getAllCategories($lang);

        // Получаем погоду
        $weatherService = new WeatherService();
        $weather = $weatherService->getCurrentWeather();

        // Получаем курсы валют
        $currencyService = new CurrencyService();
        $currency = $currencyService->getRates();

        // Получаем даты с новостями для текущего месяца
        $calendarDates = $postModel->getDatesWithNews(date('m'), date('Y'));

        // Получаем последние видео
        $videos = $this->videoModel->getLatest($lang, 4);

        // Получаем рекламу для главной страницы
        $sidebarAds = $this->adModel->getActiveByPosition('sidebar');
        $contentAds = $this->adModel->getActiveByPosition('content_bottom');

        // Передаем данные в представление
        $this->view('home/index', [
            'lang' => $lang,
            'heroPost' => $heroPost,
            'announcements' => $announcements,
            'latestNews' => $latestNews,
            'popularNews' => $popularNews,
            'weather' => $weather,
            'currency' => $currency,
            'categories' => $categories,
            'calendarDates' => $calendarDates,
            'videos' => $videos,
            'sidebarAds' => $sidebarAds,
            'contentAds' => $contentAds
        ]);
    }

    /**
     * Страница редакции
     */
    public function editor()
    {
        $lang = $this->getLang();
        $categories = $this->categoryModel->getAllCategories($lang);

        // Получаем погоду и валюту для навигации (если они нужны в хедере/футере)
        $weatherService = new WeatherService();
        $weather = $weatherService->getCurrentWeather();
        $currencyService = new CurrencyService();
        $currency = $currencyService->getRates();

        $this->view('home/editor', [
            'lang' => $lang,
            'categories' => $categories,
            'weather' => $weather,
            'currency' => $currency,
            'pageTitle' => $lang === 'kz' ? 'Редакция — ZYNDAN.KZ' : 'Редакция — ZYNDAN.KZ'
        ]);
    }
}
