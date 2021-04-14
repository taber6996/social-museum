<?php

function estaLogado() {
  return isset($_SESSION['login']);
}

function esAdmin() {
  return estaLogado() && isset($_SESSION['esAdmin']);
}
