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

    if (filter != "")
        for (i = 0; i < li.length && cont < 5; i++) {
            a = li[i].getElementsByTagName("a")[0];
            txtValue = a.textContent || a.innerText;
            if (txtValue.split(" - ")[0].toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
                cont++;
            } else {
                li[i].style.display = "none";
            }
        }
    else {
        for (i = 0; i < 9; i++) {
            a = li[i].getElementsByTagName("a")[0];
            li[i].style.display = "";
        }
        for (i = 9; i < li.length; i++) {
            a = li[i].getElementsByTagName("a")[0];
            li[i].style.display = "none";
        }
    }

}

function ControlloLingua() {
    var lingua = document.getElementById("id").children[document.getElementById("id").selectedIndex].innerHTML;
    var c = document.getElementById("lingua").children;
    if (lingua != "Nuova Pagina") {
        var selectLingua = [];
        var idx = lingua.split(", ")[1];

        for (i = 0; i < document.getElementById("id").children.length; i++) {
            if (document.getElementById("id").children[i].innerHTML.split(", ")[1])
                selectLingua.push(document.getElementById("id").children[i].innerHTML.split(", ")[2]);
        }

        document.getElementById("lingua").selectedIndex = -1;
        cont = 0;
        for (i = 0; i < c.length; i++) {
            var select = c[i].innerHTML;
            if (selectLingua.includes(select))
                c[i].style.display = "none";
            else {
                c[i].style.display = "";
                document.getElementById("lingua").selectedIndex = i;
                cont++
            }
        }
        if (cont == 0) {
            alert("Nessuna lingua disponibile per questa voce");
            document.getElementById("btn").style.display = "none";
        } else
            document.getElementById("btn").style.display = "";
    } else {
        for (i = 0; i < c.length; i++)
            c[i].style.display = "";
        document.getElementById("lingua").selectedIndex = 0;
        document.getElementById("btn").style.display = "";
    }
}