var geserElement = document.getElementById('geser');
var modeSwitchButton = document.getElementById('modeSwitch');
var row = document.getElementById('rowback');
var isOffsetThree = false;

modeSwitchButton.addEventListener('click', function () {
  if (isOffsetThree) {
    geserElement.classList.remove('offset-3');
    geserElement.classList.add('offset-6');
    isOffsetThree = false;
  } else {
    geserElement.classList.remove('offset-6');
    geserElement.classList.add('offset-3');
    isOffsetThree = true;
  }
});

var isRegisterMode = true;

modeSwitchButton.addEventListener('click', function () {
  if (isRegisterMode) {
    modeSwitchButton.textContent = "Login";
    isRegisterMode = false;
  } else {
    modeSwitchButton.textContent = "Sign In";
    isRegisterMode = true;
  }
});