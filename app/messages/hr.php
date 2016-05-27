<?php

// app/messages/hr.php
$messages = array(
    "action.back"     => "Vrati me natrag",
    "action.first"    => "Početna",
    "action.last"     => "Kraj",
    "action.next"     => "Sljedeća",
    "action.previous" => "Prethodna",
    "yes"             => "Da",
    "no"              => "Ne"
);

//NAVIGATION
$messages["nav.users"]  = "Korisnici";
$messages["nav.role"]   = "Uloge";
$messages["nav.home"]   = "Početna";
$messages["nav.silver"] = "Srebrni VIP sadržaj";

//AUTH
$messages["auth.credentials.error"]      = "Pogrešan unos";
$messages["auth.captcha.error"]          = 'Pogriješili ste kod prepisivanja vrijednosti captche';
$messages["auth.enabled.error"]          = "Vaš korisnički račun nije aktivan";
$messages["auth.registration.completed"] = "Uspješno ste registrirali korisnički račun";
$messages["login.title"]                 = "Forma za prijavu u aplikaciju";
$messages["register.title"]              = "Forma za registraciju";
$messages["username"]                    = "Korisničko ime";
$messages["password"]                    = "Lozinka";
$messages["login"]                       = "Prijava";
$messages["loginas"]                     = "Prijavi se kao";
$messages["register"]                    = "Registracija";
$messages["logout"]                      = "Odjava";
$messages["loggedin"]                    = "Dobrodošli %username%";

$messages["401.title"]   = "Neovlašteni ulaz";
$messages["401.message"] = "Niste prijavljeni u aplikaciju";
$messages["403.title"]   = "Greška kod pristupa";
$messages["403.message"] = "Nemate pravo pristupa navedenom resursu";
$messages["404.title"]   = "Greška kod resursa";
$messages["404.message"] = "Navedeni resurs ne postoji";
$messages["500.title"]   = "Greška u aplikaciji";
$messages["500.message"] = "Dogodila se greška ko procesiranja podataka, ukoliko se greška ponavlja prijavite ju!";

//BUTTONS
$messages["btn.search"] = "Traži";
$messages["btn.save"]   = "Spremi";
$messages["btn.edit"]   = "Uredi";
$messages["btn.delete"] = "Obriši";
$messages["btn.new"]    = "Kreiraj";


//CRUD
$messages["search.title"]         = "Traži %model%";
$messages["edit.title"]           = "Uredi %model%";
$messages["new.title"]            = "Kreiraj %model%";
$messages["create.link.message"]  = "Kreiraj novi unos";
$messages["action.search.empty"]  = "Pretraga nije pronašla rezultate";
$messages["action.search.result"] = "Rezultat pretrage";

//User
$messages["users.what"]                  = "Korisnik";
$messages["users.whom"]                  = "Korisnika";
$messages["users.name.label"]            = "Ime";
$messages["users.email.label"]           = "Email";
$messages["users.password.label"]        = "Lozinka";
$messages["users.oldpassword.label"]     = "Trenutna lozinka";
$messages["users.newpassword.label"]     = "Nova lozinka";
$messages["users.confirmpassword.label"] = "Potvrda lozinke";
$messages["users.enabled.label"]         = "Aktivan";
$messages["users.created.label"]         = "Kreiran";
$messages["users.updated.label"]         = "Zadnje promjene";
$messages["users.role.label"]            = "Uloga";

$messages["users.name.presence.error"]            = "Niste unijeli ime";
$messages["users.email.error"]                    = "Email adresa nije validna";
$messages["users.email.unique.error"]             = "Email adresa mora biti jedinstvena";
$messages["users.password.presence.error"]        = "Niste unijeli lozinku";
$messages["users.oldpassword.presence.error"]     = "Niste unijeli trenutnu lozinku";
$messages["users.newpassword.presence.error"]     = "Niste unijeli novu lozinku";
$messages["users.confirmpassword.presence.error"] = "Niste unijeli potvrdu lozinke";
$messages["users.confirmpassword.notequal.error"] = "Lozinke se ne podudaraju";
$messages["users.password.credentials.error"]     = "Unijeli ste pogrešnu lozinku";

$messages["users.updated"] = "Korisnik je uspješno pohranjen.";
$messages["users.created"] = "Korisnik je uspješno kreiran.";

//Role
$messages["role.what"]                    = "Uloga";
$messages["role.whom"]                    = "Ulogu";
$messages["role.unique.error"]            = "Naziv uloge mora biti jedinstven";
$messages["role.name.label"]              = "Naziv uloge";
$messages["role.delete.sweetalert.title"] = "Jeste li sigurni?";
$messages["role.delete.sweetalert.text"]  = "Obrisat ćete ulogu";

$messages["role.updated"] = "Uloga je uspješno pohranjena.";
$messages["role.created"] = "Uloga je uspješno kreirana.";
$messages["role.deleted"] = "Uloga je uspješno izbrisana.";

$messages["role.validation.error.pressenceof"] = "Niste unijeli naziv uloge!";

//SILVER
$messages["silver.title"] = "Premium content";

//Global messages
$messages["model.not.found"] = "%modelName% nije pronađen/a";