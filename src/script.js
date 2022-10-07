function loadstreets() {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        let data = JSON.parse(this.responseText);
        for (const value in data) {
            let id = `${data[value]['id']}`;
            //let playername = `${players[value]['Name']}`;
            //let skinlink = `${players[value]['Skin']}`;
            document.getElementById("money").innerHTML = `${data["money"]}`+"$";
            document.getElementById(id).style.display = "block";
            if (id === "I" || id === "II") {
                document.getElementById(1).style.display = "block";
            } else if (id === "III" || id === "IV" || id === "V") {
                document.getElementById(2).style.display = "block";
            } else if (id === "VI" || id === "VII" || id === "VIII") {
                document.getElementById(3).style.display = "block";
            } else if (id === "IX" || id === "X" || id === "XI") {
                document.getElementById(4).style.display = "block";
            } else if (id === "XII" || id === "XIII" || id === "XIV") {
                document.getElementById(5).style.display = "block";
            } else if (id === "XV" || id === "XVI" || id === "XVII") {
                document.getElementById(6).style.display = "block";
            } else if (id === "XXIV" || id === "XXV" || id === "XXVI") {
                document.getElementById(7).style.display = "block";
            } else if (id === "XVIII" || id === "XIX") {
                document.getElementById(8).style.display = "block";
            } else if (id === "XXVII" || id === "XXVIII") {
                document.getElementById(9).style.display = "block";
            } else if (id === "XX" || id === "XXI" || id === "XXII") {
                document.getElementById(10).style.display = "block";
            }
        }
    }
    xhttp.open("GET", "src/data.php", true);
    xhttp.send();
}