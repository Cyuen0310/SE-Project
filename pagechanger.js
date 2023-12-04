// Function to generate the appropriate cards based on the user type
function generateCards(userType) {
  const cardContainer = document.getElementById("cardContainer");
  cardContainer.innerHTML = ""; // Clear any existing cards

  if (userType === "student") {
    const informationCard = createCard("personalData", "Personal Data");
    const academicCard = createCard("enrolledCourses", "Enrolled Courses");

    cardContainer.appendChild(informationCard);
    cardContainer.appendChild(academicCard);
  } else if (userType === "staff") {
    const informationCard = createCard("personalData", "Personal Data");
    const taughtCoursesCard = createCard("taughtCourses", "Taught Courses");

    cardContainer.appendChild(informationCard);
    cardContainer.appendChild(taughtCoursesCard);
  }

  // Initially display relevant content section based on userType
  showRelevantContentSection(userType);
}

// Function to create a card element
function createCard(contentId, title) {
  const card = document.createElement("div");
  card.classList.add("card");

  const heading = document.createElement("h4");
  heading.textContent = title;

  card.appendChild(heading);

  card.addEventListener("click", function () {
    hideAllContentSections();
    showContentSection(contentId);
  });

  return card;
}

// Function to hide all content sections
function hideAllContentSections() {
  const contentSections = document.getElementsByClassName("content-section");
  for (let i = 0; i < contentSections.length; i++) {
    contentSections[i].style.display = "none";
  }
}

// Function to show a specific content section
function showContentSection(contentId) {
  const selectedContent = document.getElementById(contentId);
  selectedContent.style.display = "block";
}

// Function to show the relevant content section based on the user type
function showRelevantContentSection(userType) {
  if (userType === "student") {
    showContentSection("personalData");
    showContentSection("enrolledCourses");
  } else if (userType === "staff") {
    showContentSection("personalData");
    showContentSection("taughtCourses");
  }
}

// Call the generateCards function with the userType
generateCards(userType);
