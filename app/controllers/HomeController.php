<?php

require_once BASE_PATH . '/app/helpers/Lang.php';
require_once BASE_PATH . '/app/models/EventModel.php';

class HomeController
{
    private EventModel $model;

    // Locales supported by the application
    private const SUPPORTED = ['pt', 'en'];

    public function __construct()
    {
        $this->model = new EventModel();
    }

    /**
     * Detects the active locale (priority: session > browser > default).
     */
    private function resolveLocale(): string
    {
        // 1 — Session
        if (!empty($_SESSION['locale']) && in_array($_SESSION['locale'], self::SUPPORTED, true)) {
            return $_SESSION['locale'];
        }

        // 2 — Browser Accept-Language header
        $accept = $_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? '';
        if (str_contains($accept, 'en')) {
            $_SESSION['locale'] = 'en';
            return 'en';
        }

        // 3 — Default: Portuguese
        $_SESSION['locale'] = 'pt';
        return 'pt';
    }

    /**
     * Renders the home page.
     */
    public function index(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Handle language switch via POST (keeps URL clean)
        if (!empty($_POST['lang']) && in_array($_POST['lang'], self::SUPPORTED, true)) {
            $_SESSION['locale'] = $_POST['lang'];
            header('Location: /');
            exit;
        }

        // Resolve locale and load translations
        $locale = $this->resolveLocale();
        Lang::load($locale);

        // Load data from the model
        $lineup          = $this->model->getLineup();
        $events          = $this->model->getEvents();
        $tickets         = $this->model->getTickets();
        $countdownTarget = $this->model->getCountdownTarget();

        // Capture the view output
        ob_start();
        include __DIR__ . '/../views/home/index.php';
        $content = ob_get_clean();

        // Render through the main layout
        include __DIR__ . '/../views/layouts/main.php';
    }
}
