<?php

$this->get('noticias', function ($arg) {
  $tpl = $this->core->loadModule('template');
  $news = $this->core->loadModule('news');

  $array = array();
  $array['news'] = $news->getNewsList();

  $tpl->render('noticias_lista', $array);
});

$this->get('noticias/{id}', function ($arg) {
});
