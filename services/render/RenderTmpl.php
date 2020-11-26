<?php


namespace App\services\render;


class RenderTmpl implements IRenderer
{
    public function render($template, $params = [])
    {
        $content = $this->renderTemplate($template, $params);
        echo $this->renderTemplate('layouts/main', [
            'content' => $content
        ]);
    }

    protected function renderTemplate($template, $params)
    {
        ob_start();
        extract($params);
        include dirname(__DIR__, 2) . '/views/' . $template . '.php';
        return ob_get_clean();
    }
}