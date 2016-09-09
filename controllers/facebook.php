<?php
$app->get('/facebook/:id', function($id) use ($app, $fb) {
  $app->response->setStatus(200);
  $app->response->headers->set('Content-Type', 'application/json');
  $fb = new \Facebook\Facebook([
    'app_id' => FB_APP_ID,
    'app_secret' => FB_APP_SECRET,
    'default_graph_version' => 'v2.7',
    'default_access_token' => FB_APP_ID . '|' . FB_APP_SECRET,
  ]);

  $jobs = [];
  foreach (json_decode($fb->get('/' . $id . '/feed?limit=100')->getBody(), true)['data'] as $post) {
    $any = ['apply', 'hiring', 'we', "we're"];
    $none = ['finding', 'aca', 'Academy', 'my', 'they'];
    $query = $app->request->params('query') ? $app->request->params('query') : ' ';
    if (
    isset($post['message']) &&
    count(array_intersect(explode(' ', $post['message']), $any)) > 0 &&
    count(array_intersect(explode(' ', $post['message']), $none)) == 0 &&
    strpos($post['message'], $query) != false
    ) {
      $isHiring = strpos($post['message'], 'is hiring');
      if ($isHiring !== false) {
        foreach (explode(' ', $post['message']) as $idx => $word){
          if (preg_match('/hiring*/',$word)){
            $hiringIdx = $idx;
          }
        }
        $company = '';
        for ($i = $hiringIdx - 2; $i >= 0; $i--) {
          $firstLetter = explode(' ', $post['message'])[$i][0];
          if (ctype_upper($firstLetter) || is_numeric($firstLetter)) {
            $company = explode(' ', $post['message'])[$i] . ' ' . $company;
          } else {
            break;
          }
        }
        $post['company'] = $company;
        $jobs[] = $post;
      }
    }
  }

  $app->response->write(json_encode($jobs));

  return $app->response;
});
