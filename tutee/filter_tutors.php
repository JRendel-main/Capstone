<?php

// Get filters and search term from GET parameters
$filters = $_GET['filters'] ?? array();
$searchTerm = $_GET['searchTerm'] ?? '';

// Sample data for tutors
$tutors = array(
  array('name' => 'John Doe', 'department' => 'Computer Science', 'rating' => 4.5, 'interests' => array('Coding', 'Design', 'Math')),
  array('name' => 'Jane Smith', 'department' => 'Mathematics', 'rating' => 3.8, 'interests' => array('Math', 'Science', 'Research')),
  array('name' => 'Mike Johnson', 'department' => 'Physics', 'rating' => 4.2, 'interests' => array('Physics', 'Engineering', 'Astronomy')),
  array('name' => 'Sara Lee', 'department' => 'Computer Science', 'rating' => 4.0, 'interests' => array('Coding', 'Web Development', 'Data Science')),
  array('name' => 'Bob Wilson', 'department' => 'Mathematics', 'rating' => 3.5, 'interests' => array('Math', 'Statistics', 'Data Analysis')),
  array('name' => 'Lisa Chen', 'department' => 'Physics', 'rating' => 4.8, 'interests' => array('Physics', 'Research', 'Data Visualization')),
);

// Filter tutors based on selected filters
$filteredTutors = array();
foreach ($tutors as $tutor) {
  // Filter by department
  if (!empty($filters['department']) && !in_array($tutor['department'], $filters['department'])) {
    continue;
  }
  // Filter by rating
  if (!empty($filters['rating'])) {
    $foundRating = false;
    foreach ($filters['rating'] as $rating) {
      if ($tutor['rating'] >= (float)$rating) {
        $foundRating = true;
        break;
      }
    }
    if (!$foundRating) {
      continue;
    }
  }
  // Filter by interests
  if (!empty($filters['interest']) && count(array_intersect($tutor['interests'], $filters['interest'])) == 0) {
    continue;
  }
  $filteredTutors[] = $tutor;
}

// Sort filtered tutors by name
usort($filteredTutors, function($a, $b) {
  return strcmp($a['name'], $b['name']);
});

// Filter tutors based on search term
if (!empty($searchTerm)) {
  $searchResults = array_filter($filteredTutors, function($tutor) use ($searchTerm) {
    return strpos(strtolower($tutor['name']), strtolower($searchTerm)) !== false;
  });
} else {
  $searchResults = $filteredTutors;
}

?>