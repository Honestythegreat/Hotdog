document.getElementById('dropdownbtn1').addEventListener('click', function() {
    document.getElementById('dropdowncontent1').classList.toggle('show');
  });
  
  document.getElementById('dropdownbtn2').addEventListener('click', function() {
    document.getElementById('dropdownselect2').classList.toggle('show');
  });
  
  window.onclick = function(event) {
    if (!event.target.matches('.dropdown-button')) {
        var dropdownsContent = document.getElementsByClassName("dropdown-content");
        for (var i = 0; i < dropdownsContent.length; i++) {
            var openDropdownContent = dropdownsContent[i];
            if (openDropdownContent.classList.contains('show')) {
                openDropdownContent.classList.remove('show');
            }
        }
  
        var dropdownsSelect = document.getElementsByClassName("dropdown-select");
        for (var i = 0; i < dropdownsSelect.length; i++) {
            var openDropdownSelect = dropdownsSelect[i];
            if (openDropdownSelect.classList.contains('show')) {
                openDropdownSelect.classList.remove('show');
            }
        }
    }
  };