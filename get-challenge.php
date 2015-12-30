<?php
header('Content-Type: application/json');

echo json_encode(getChallenge());

function getChallenge() {
  $challenge = array();

  $categories = getCategories();
  // Shuffle the categories.
  shuffle($categories);
  // retrieve the top four.
  $categories = array_slice($categories, 0, 4);
  // grab the images from the first.
  shuffle($categories[0]['images']);
  // use the first imsage.
  $challenge['image'] = array(
    'url' => $categories[0]['images'][0]['url'],
    'id' => $categories[0]['images'][0]['id'],
  );
  // Build the answer
  $challenge['answer'] = array(
    'id' => md5($challenge['image']['id'] . $categories[0]['id']),
    'role' => $categories[0]['role'],
    'title' => $categories[0]['title'],
    'source' => $categories[0]['images'][0]['source'],
    'correct' => getResponse('correct'),
    'incorrect' => getResponse('incorrect'),
  );

  // Build the options.
  shuffle($categories);
  foreach ($categories as $category) {
    $challenge['options'][] = array(
      'id' => $category['id'],
      'title' => $category['title'],
    );
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
  return array(
    array(
      'id' => '1',
      'title' => 'Doctor Strange (2016)',
      'role' => 'Dr. Stephen Strange',
      'images' => array(array(
          "url" => "http://ia.media-imdb.com/images/M/MV5BMTQzMDEwNjUzNV5BMl5BanBnXkFtZTgwOTg2MzU0MzE@._V1_UY317_CR1,0,214,317_AL_.jpg",
          "id" => "6cf0eaf750f40b5c975954dd6a9d2f38",
          "source" => 'http://www.google.com',
    ),),
    ),
    array(
      'id' => '2',
      'title' => 'Zoolander 2 (2016)',
      'role' => 'All',
      'images' => array(array(
          "url" => "http://ia.media-imdb.com/images/M/MV5BMTQzMDEwNjUzNV5BMl5BanBnXkFtZTgwOTg2MzU0MzE@._V1_UY317_CR1,0,214,317_AL_.jpg",
          "id" => "6cf0eaf750f40b5c975954dd6a9d2f38",
          "source" => 'http://www.google.com',
    ),),
    ),
    array(
      'id' => '3',
      'title' => 'Sherlock (2010 - 2017)',
      'role' => 'Sherlock Holmes',
      'images' => array(array(
          "url" => "http://ia.media-imdb.com/images/M/MV5BMTQzMDEwNjUzNV5BMl5BanBnXkFtZTgwOTg2MzU0MzE@._V1_UY317_CR1,0,214,317_AL_.jpg",
          "id" => "6cf0eaf750f40b5c975954dd6a9d2f38",
          "source" => 'http://www.google.com',
    ),),
    ),
    array(
      'id' => '4',
      'title' => 'The Hollow Crown (2016)',
      'role' => 'Richard III',
      'images' => array(array(
          "url" => "http://ia.media-imdb.com/images/M/MV5BMTQzMDEwNjUzNV5BMl5BanBnXkFtZTgwOTg2MzU0MzE@._V1_UY317_CR1,0,214,317_AL_.jpg",
          "id" => "6cf0eaf750f40b5c975954dd6a9d2f38",
          "source" => 'http://www.google.com',
    ),),
    ),
    array(
      'id' => '5',
      'title' => 'National Theatre Live: Hamlet (2015)',
      'role' => 'Hamlet',
      'images' => array(array(
          "url" => "http://ia.media-imdb.com/images/M/MV5BMTQzMDEwNjUzNV5BMl5BanBnXkFtZTgwOTg2MzU0MzE@._V1_UY317_CR1,0,214,317_AL_.jpg",
          "id" => "6cf0eaf750f40b5c975954dd6a9d2f38",
          "source" => 'http://www.google.com',
    ),),
    ),
    array(
      'id' =>  '6',
      'title' => 'Black Mass (2015)',
      'role' => 'Billy Bulger',
      'images' => array(array(
          "url" => "http://ia.media-imdb.com/images/M/MV5BMTQzMDEwNjUzNV5BMl5BanBnXkFtZTgwOTg2MzU0MzE@._V1_UY317_CR1,0,214,317_AL_.jpg",
          "id" => "6cf0eaf750f40b5c975954dd6a9d2f38",
          "source" => 'http://www.google.com',
    ),),
    ),
    array(
      'id' => '7',
      'title' => 'The Hobbit: The Battle of the Five Armies (2014)',
      'role' => 'Smaug',
      'images' => array(array(
          "url" => "http://ia.media-imdb.com/images/M/MV5BMTQzMDEwNjUzNV5BMl5BanBnXkFtZTgwOTg2MzU0MzE@._V1_UY317_CR1,0,214,317_AL_.jpg",
          "id" => "6cf0eaf750f40b5c975954dd6a9d2f38",
          "source" => 'http://www.google.com',
    ),),
    ),
    array(
      'id' => '8',
      'title' => 'Penguins of Madagascar (2014)',
      'role' => 'Classified',
      'images' => array(array(
          "url" => "http://ia.media-imdb.com/images/M/MV5BMTQzMDEwNjUzNV5BMl5BanBnXkFtZTgwOTg2MzU0MzE@._V1_UY317_CR1,0,214,317_AL_.jpg",
          "id" => "6cf0eaf750f40b5c975954dd6a9d2f38",
          "source" => 'http://www.google.com',
    ),),
    ),
    array(
      'id' => '9',
      'title' => 'The Imitation Game (2014)',
      'role' => 'Alan Turing',
      'images' => array(array(
          "url" => "http://ia.media-imdb.com/images/M/MV5BMTQzMDEwNjUzNV5BMl5BanBnXkFtZTgwOTg2MzU0MzE@._V1_UY317_CR1,0,214,317_AL_.jpg",
          "id" => "6cf0eaf750f40b5c975954dd6a9d2f38",
          "source" => 'http://www.google.com',
    ),),
    ),
  );
}








