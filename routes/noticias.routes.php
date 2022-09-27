<?php

$this->get('noticias', function ($arg) {
  echo 'entrou em noticias';
});

$this->get('noticias/{id}', function ($arg) {
  echo 'hello';
});
