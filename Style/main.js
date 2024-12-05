function pindahPage() {
  window.location.href = "Main/marketplace.php";
}

function editPage() {
  window.location.href = "edit.php";
}

function toggleMenu() {
  const burgerIcon = document.getElementById('burger');
  const cancelIcon = document.getElementById('cancel');

  if (burgerIcon.style.display === 'none') {
      burgerIcon.style.display = 'inline-block';
      cancelIcon.style.display = 'none';
  } else {
      burgerIcon.style.display = 'none';
      cancelIcon.style.display = 'inline-block';
  }
}

function toggleMenu() {
  const logout = document.getElementById('logout');
  const burgerIcon = document.getElementById('burger');
  const cancelIcon = document.getElementById('cancel');

  // Toggle the active class for showing/hiding the menu
  navList.classList.toggle('active');

  // Toggle the icons (burger and cancel)
  if (burgerIcon.style.display === 'none') {
      burgerIcon.style.display = 'block';
      cancelIcon.style.display = 'none';
      logout.style.display = 'none';
  } else {
      burgerIcon.style.display = 'none';
      cancelIcon.style.display = 'block';
      logout.style.display = 'block';
  }
}


