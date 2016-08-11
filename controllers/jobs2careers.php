<?php
$app->get('/jobs2careers', function() use ($app) {
  $app->response->setStatus(200);
  $app->response->headers->set('Content-Type', 'application/json');
  $url = 'http://api.jobs2careers.com/api/search.php?id=' . J2C_ID
  . '&pass=' . J2C_PASS
  . '&ip=' . gethostbyname(gethostname())
  . '&q=' . $app->request->params("query")
  . '&l=' . $app->request->params("location")
  . '&industry=' . $app->request->params("industry")
  . '&limit=' . $app->request->params("limit")
  . '&sort=' . $app->request->params("sort")
  . '&start=' . $app->request->params("start")
  . '&format=json';
  $app->response->write(file_get_contents($url));
  return $app->response;
});
