function search() {
    var input, filter, ul, li, a, i, txtValue, max;
    cont = 0;
    input = document.getElementById("searchbar");
    if (input.value != null)
        filter = input.value.toUpperCase();
    else
        filter = "";
    ul = document.getElementById("searchlist");
    li = ul.getElementsByTagName("li");


    for (i = 0; i < li.length && cont < 5; i++) {
        a = li[i].getElementsByTagName("a")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
            cont++;
        } else {
            li[i].style.display = "none";
        }
    }
}