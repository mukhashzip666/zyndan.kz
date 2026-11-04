<?php
/**
 * CategoryController - Контроллер категорий
 */

require_once __DIR__ . '/../../core/Controller.php';

class CategoryController extends Controller
{
    private $postModel;
    private $categoryModel;

    public function __construct()
    {
        parent::__construct();
        $this->postModel = $this->model('PostModel');
        $this->categoryModel = $this->model('CategoryModel');
    }

    /**
     * Показать посты категории (или все новости для zhanalyqtar / novosti)
     */
    public function show($categorySlug)
    {
        $isAllNews = in_array($categorySlug, ['zhanalyqtar', 'novosti', 'all', 'news'], true);

        // Получаем категорию
        $category = $this->categoryModel->getBySlug($categorySlug, $this->lang);

        if (!$category && $isAllNews) {
            $category = [
                'id' => 0,
                'name' => $this->lang === 'kz' ? 'Барлық жаңалықтар' : 'Все новости',
                'slug' => $this->lang === 'kz' ? 'zhanalyqtar' : 'novosti',
                'description' => $this->lang === 'kz' ? 'Порталда жарияланған барлық жаңалықтар тізімі' : 'Полный список всех опубликованных новостей портала'
            ];
        }

        if (!$category) {
            http_response_code(404);
            echo "Категория не найдена (slug: $categorySlug, lang: {$this->lang})";
            return;
        }

        // Пагинация
        $page = isset($_GET['page']) ? max(1, (int) $_GET['page']) : 1;
        $perPage = 15;
        $offset = ($page - 1) * $perPage;

        // Если это общий раздел "Жаңалықтар / Новости" — показываем ВСЕ опубликованные новости всех категорий
        if ($isAllNews) {
            $posts = $this->postModel->getPublished($this->lang, $perPage, $offset);
            $totalPosts = $this->postModel->countPublished();
        } else {
            $posts = $this->postModel->getByCategory($categorySlug, $this->lang, $perPage, $offset);
            $totalPosts = $this->postModel->countByCategory($categorySlug, $this->lang);
        }

        $totalPages = max(1, (int) ceil($totalPosts / $perPage));

        // Получаем все категории для меню
        $categories = $this->categoryModel->getAllCategories($this->lang);

        // Передаем данные в представление
        $this->view('category/index', [
            'category' => $category,
            'posts' => $posts,
            'categories' => $categories,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'totalPosts' => $totalPosts
        ]);
    }
}
