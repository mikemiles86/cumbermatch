<?php
header('Content-Type: application/json');

echo json_encode(getChallenge());

function getChallenge() {
  $challenge = array();

  if ($categories = getCategories()) {
    // Shuffle the categories.
    shuffle($categories);
    // retrieve the top four.
    $categories = array_slice($categories, 0, 4);
    // grab the images from the first.
    shuffle($categories[0]['images']);
    // use the first image.
    $challenge['image'] = $categories[0]['images'][0];

    // Build the answer.
    $challenge['answer'] = array(
      'id' => md5($challenge['image']['id'] . $categories[0]['id']),
      'role' => $categories[0]['role'],
      'title' => $categories[0]['title'],
      'source' => $challenge['image']['source'],
      'correct' => getResponse('correct'),
      'incorrect' => getResponse('incorrect'),
    );

    // Build the options.
    shuffle($categories);
    foreach ($categories as $category) {
      $challenge['options'][] = array(
        'id' => $category['id'],
        'title' => $category['title']['name'] . ($category['year'] ? ' (' . $category['year'] . ')' : ''),
      );
    }
  }

  return (object)$challenge;
}

function getResponse($type = 'correct') {

  $responses = array(
    'correct' => array(
      'Penglings',
      'Jolly Good',
      'Elementry',
      'Smashing',
      'Ha-Ha',
      'Good Show',
      'Quite Right',
    ),

    'incorrect' => array(
      'Boring',
      'Simpleton',
      'How Drole',
      'I dare say',
      'Dear God',
      'Why I never',
      'The nerve',
      'How dare you',
      'Bloody hell',
    ),
  );

  shuffle($responses[$type]);

  return $responses[$type][0];
}

function getCategories() {
  $categories = FALSE;
  if ($categories = unserialize(file_get_contents('data/data.txt'))) {

  }

  return $categories;
}








