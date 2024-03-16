<?php
/*
    Controller za novice. Vključuje naslednje standardne akcije:
        index: izpiše vse novice
        show: izpiše posamezno novico
*/
class articles_controller
{
    public function index()
    {
        //s pomočjo statične metode modela, dobimo seznam vseh novic
        //$ads bo na voljo v pogledu za vse oglase index.php
        $articles = Article::all();

        //pogled bo oblikoval seznam vseh oglasov v html kodo
        require_once('views/articles/index.php');
    }

    public function show()
    {
        //preverimo, če je uporabnik podal informacijo, o oglasu, ki ga želi pogledati
        if (!isset($_GET['id'])) {
            return call('pages', 'error'); //če ne, kličemo akcijo napaka na kontrolerju stran
            //retun smo nastavil za to, da se izvajanje kode v tej akciji ne nadaljuje
        }
        //drugače najdemo oglas in ga prikažemo
        $article = Article::find($_GET['id']);
        require_once('views/articles/show.php');
    }

    public function create()
    {
        $error = "";
        if (isset($_GET["error"])) {
            switch ($_GET["error"]) {
                case 1:
                    $error = "Izpolnite vsa polja";
                    break;
                default:
                    $error = "Prišlo je do napake med vstavljanjem nove novice.";
            }
        }
        require_once('views/articles/create.php');
    }


    public function store()
    {
        if (empty($_POST["title"]) || empty($_POST["abstract"]) || empty($_POST["text"])) {
            header("Location: /articles/create?error=1");
        } else if (Article::create($_POST["title"], $_POST["abstract"], $_POST["text"])) {
            header("Location: /articles/index");
        } else {
            header("Location: /articles/create?error=2");
        }

    }

    public function edit()
    {
        $error = "";
        if (!isset($_GET['id'])) {
            header("Location: /pages/error");
            die();
        }
        $article = Article::find($_GET['id']);
        if (isset($_GET["error"])) {
            switch ($_GET["error"]) {
                case 1:
                    $error = "Izpolnite vsa polja";
                    break;
                default:
                    $error = "Prišlo je do napake med vstavljanjem nove novice.";
            }
        }
        require_once('views/articles/edit.php');
    }

    public function update()
    {
        if (empty($_POST["title"]) || empty($_POST["abstract"]) || empty($_POST["text"])) {
            header("Location: /articles/edit?id=" . $_POST["id"] . "&error=1");
        } else if (Article::update($_POST["id"], $_POST["title"], $_POST["abstract"], $_POST["text"])) {
            header("Location: /articles/index");
        } else {
            header("Location: /articles/edit?id=" . $_POST["id"] . "&error=2");
        }
    }

    public function list()
    {
        if (isset($_SESSION["USER_ID"])) {
            $articles = Article::filter($_SESSION["USER_ID"]);
            require_once('views/articles/list.php');
        } else {
            return call('pages', 'error');
        }
    }

    public function delete()
    {
        if (isset($_GET['id'])) {
            if (Article::delete($_GET['id'])) {
                header("Location: /articles/index");
            } else {
                header("Location: /articles/index?error=1");
            }
        } else {
            return call('pages', 'error');
        }
    }
}