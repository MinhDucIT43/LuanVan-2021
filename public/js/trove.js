var back = document.getElementById('back');
back.onclick = goBack;

function goBack() {
  window.history.back();
}