function deleteMedicine(id) {
    var confirmation = confirm("Are you sure?");
    if (confirmation) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState = 4 && xhttp.status == 200)
                document.getElementById('medicines_div').innerHTML = xhttp.responseText;
        };
        xhttp.open("GET", "php/manage_diagnosis.php?action=delete&id=" + id, true);
        xhttp.send();
    }
}

function editMedicine(id) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState = 4 && xhttp.status == 200)
            document.getElementById('medicines_div').innerHTML = xhttp.responseText;
    };
    xhttp.open("GET", "php/manage_diagnosis.php?action=edit&id=" + id, true);
    xhttp.send();
}

function updateMedicine(id) {
    var medicine_name = document.getElementById("medicine_name");

    if (!notNull(medicine_name.value, "medicine_name_error"))
        medicine_name.focus();
    else {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState = 4 && xhttp.status == 200)
                document.getElementById('medicines_div').innerHTML = xhttp.responseText;
        };
        xhttp.open("GET", "php/manage_diagnosis.php?action=update&id=" + id + "&name=" + medicine_name.value + "&packing=" + packing.value + "&generic_name=" + generic_name.value + "&suppliers_name=" + suppliers_name.value, true);
        xhttp.send();
    }
}

function cancel() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState = 4 && xhttp.status == 200)
            document.getElementById('medicines_div').innerHTML = xhttp.responseText;
    };
    xhttp.open("GET", "php/manage_diagnosis.php?action=cancel", true);
    xhttp.send();
}

function searchMedicine(text, tag) {
    if (tag == "name") {
        document.getElementById("by_name").value;
    }

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState = 4 && xhttp.status == 200)
            document.getElementById('medicines_div').innerHTML = xhttp.responseText;
    };
    xhttp.open("GET", "php/manage_diagnosis.php?action=search&text=" + text + "&tag=" + tag, true);
    xhttp.send();
}