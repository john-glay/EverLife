function displayDepValue() {
    // Get the value of the input element
    var name = document.getElementById('input-depName').value;
    var relationship = document.getElementById('input-depRelationship').value;
    var bday = document.getElementById('input-depBday').value;
    
    // Set the text content of the display element
    document.getElementById('display-depName').textContent = name;
    document.getElementById('display-depRelationship').textContent = relationship;
    document.getElementById('display-depBday').textContent = bday;
}

function depRadioValue() {
    // Get the value of the input element
    var disability = document.querySelector('input[name="dep_perm_disability"]:checked');
    var citizenship = document.querySelector('input[name="dep_citizenship"]:checked');

    // Set the text content of the display element
    if (disability.value == "Y") {
        document.getElementById('display-depDisability').textContent = "Yes";
    } else if (disability.value == "N") {
        document.getElementById('display-depDisability').textContent = "No";
    }

    if (citizenship.value == "F") {
        document.getElementById('display-depCitizenship').textContent = "Filipino";
    } else if (citizenship.value == "FN") {
        document.getElementById('display-depCitizenship').textContent = "Foreign National";
    } else if (citizenship.value == "DC") {
        document.getElementById('display-depCitizenship').textContent = "Dual Citizen";
    } 
}

function displayInputValue() {
    // Get the value of the input element
    var name = document.getElementById('input-name').value;
    var mother = document.getElementById('input-mother').value;
    var spouse = document.getElementById('input-spouse').value;
    var bday = document.getElementById('input-bday').value;
    var bplace = document.getElementById('input-bplace').value;
    var philsys = document.getElementById('input-philsys').value;
    var tin = document.getElementById('input-tin').value;
    var permAdrs = document.getElementById('input-permAdrs').value;
    var mailAdrs = document.getElementById('input-mailAdrs').value;
    var homePhone = document.getElementById('input-homePhone').value;
    var mobile = document.getElementById('input-mobile').value;
    var business = document.getElementById('input-business').value;
    var email = document.getElementById('input-email').value;
    var SIOther = document.getElementById('input-SIOther').value;
    var praSSRV = document.getElementById('input-praSSRV').value;
    var acrICard = document.getElementById('input-acrICard').value;
    var pwdID = document.getElementById('input-pwdID').value;
    var profession = document.getElementById('input-profession').value;
    var income = document.getElementById('input-income').value;
    var incomeProof = document.getElementById('input-incomeProof').value;
    
    // Set the text content of the display element
    document.getElementById('display-name').textContent = name;
    document.getElementById('display-mother').textContent = mother;
    document.getElementById('display-spouse').textContent = spouse;
    document.getElementById('display-bday').textContent = bday;
    document.getElementById('display-bplace').textContent = bplace;
    document.getElementById('display-philsys').textContent = philsys;
    document.getElementById('display-tin').textContent = tin;
    document.getElementById('display-permAdrs').textContent = permAdrs;
    document.getElementById('display-mailAdrs').textContent = mailAdrs;
    document.getElementById('display-homePhone').textContent = homePhone;
    document.getElementById('display-mobile').textContent = mobile;
    document.getElementById('display-business').textContent = business;
    document.getElementById('display-email').textContent = email;

    if (SIOther != "") {
        document.getElementById('display-conType').textContent = SIOther;
    }
    
    document.getElementById('display-praSSRV').textContent = praSSRV;
    document.getElementById('display-acrICard').textContent = acrICard;
    document.getElementById('display-pwdID').textContent = pwdID;
    document.getElementById('display-profession').textContent = profession;
    document.getElementById('display-income').textContent = income;
    document.getElementById('display-incomeProof').textContent = incomeProof;
}

function displayRadioValue() {
    // Get the value of the input element
    var sex = document.querySelector('input[name="sex"]:checked');
    var civilStatus = document.querySelector('input[name="civil_status"]:checked');
    var citizenship = document.querySelector('input[name="citizenship"]:checked');

    // Set the text content of the display element
    if (sex.value == "M") {
        document.getElementById('display-sex').textContent = "Male";
    } else if (sex.value == "F") {
        document.getElementById('display-sex').textContent = "Female";
    }

    if (civilStatus.value == "S") {
        document.getElementById('display-civilStatus').textContent = "Single";
    } else if (civilStatus.value == "A") {
        document.getElementById('display-civilStatus').textContent = "Annulled";
    } else if (civilStatus.value == "M") {
        document.getElementById('display-civilStatus').textContent = "Married";
    } else if (civilStatus.value == "W") {
        document.getElementById('display-civilStatus').textContent = "Widow/er";
    }  else if (civilStatus.value == "LS") {
        document.getElementById('display-civilStatus').textContent = "Legally Separated";
    }

    if (citizenship.value == "F") {
        document.getElementById('display-citizenship').textContent = "Filipino";
    } else if (citizenship.value == "FN") {
        document.getElementById('display-citizenship').textContent = "Foreign National";
    } else if (citizenship.value == "DC") {
        document.getElementById('display-citizenship').textContent = "Dual Citizen";
    } 
}

function displayConType(con) {
    if (con == "FD") {
        document.getElementById('display-contributor').textContent = "Family Driver";
    } else if (con == "K") {
        document.getElementById('display-contributor').textContent = "Kasambahay";
    } else if (con == "MW") {
        document.getElementById('display-contributor').textContent = "Migrant Worker";
    } else if (con == "FN") {
        document.getElementById('display-contributor').textContent = "Foreign National";
    } else if (con == "FDL") {
        document.getElementById('display-contributor').textContent = "Filipinos with Dual Citizenship / Living Abroad";
    } else if (con == "LM") {
        document.getElementById('display-contributor').textContent = "Lifetime Member";
    } else if (con == "EP") {
        document.getElementById('display-contributor').textContent = "Employed Private";
    } else if (con == "SI") {
        document.getElementById('display-contributor').textContent = "Self-Earning Individual";
    } else if (con == "EG") {
        document.getElementById('display-contributor').textContent = "Employed Government";
    } else if (con == "PP") {
        document.getElementById('display-contributor').textContent = "Professional Practitioner"; 
    } else if (con == "P") {
        document.getElementById('display-contributor').textContent = "PAMANA";
    } else if (con == "L") {
        document.getElementById('display-contributor').textContent = "Listahanan";
    } else if (con == "KK") {
        document.getElementById('display-contributor').textContent = "KIA/KIKO";
    } else if (con == "PM") {
        document.getElementById('display-contributor').textContent = "4Ps/MCCT";
    } else if (con == "BN") {
        document.getElementById('display-contributor').textContent = "Bangsamoro/Normalization";
    } else if (con == "SC") {
        document.getElementById('display-contributor').textContent = "Senior Citizen";
    } else if (con == "LGU") {
        document.getElementById('display-contributor').textContent = "LGU-sponsored";
    } else if (con == "NGA") {
        document.getElementById('display-contributor').textContent = "NGA-sponsored";
    } else if (con == "PS") {
        document.getElementById('display-contributor').textContent = "Private-sponsored";
    } else if (con == "PWD") {
        document.getElementById('display-contributor').textContent = "Person with Disability";
    }
}

function displayMigrantWorker(forConType) {
    if (forConType == "Land-Based") {
        document.getElementById('display-conType').textContent = "Land-Based";
    } else if (forConType == "Sea-Based") {
        document.getElementById('display-conType').textContent = "Sea-Based";
    } else if (forConType == "Individual") {
        document.getElementById('display-conType').textContent = "Individual";
    } else if (forConType == "Sole Proprietor") {
        document.getElementById('display-conType').textContent = "Sole Proprietor";
    } else if (forConType == "Group Enrollment Scheme") {
        document.getElementById('display-conType').textContent = "Group Enrollment Scheme";
    }
}