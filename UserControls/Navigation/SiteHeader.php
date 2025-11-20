<?php
// written by meditext & SkylerClock
namespace UserControls\Navigation;
use Roblox\Authentication as Auth;
use Roblox\Economy\Common\UserBalance;
use Roblox\Alert;
use Roblox\Controls\NavBarItems;
use Roblox\Controls\NavBarItem;
use Roblox\Controls\Panel;
// specialized area for the translation process
// todo: make all the translations and original labels be processed into a CSV file (just so to make our lifes easier)

class SiteHeader{
    private bool $isAuthenticated;
    public static array $translated_labels = [
        // top bar (header)
        "Games" => [
            "pt" => "Jogos",
            "en" => "Games",
            "de" => "Spiele",
            "es" => "Juegos",
            "fr" => "Jeux",
            "it" => "Giochi",
            "ru" => "Игры",
            "cr" => "Igre",
            "sb" => "Igre",
            "du" => "Spellen"
        ],
        "Catalog" => [
            "pt" => "Catálogo",
            "en" => "Catalog",
            "de" => "Katalog",
            "es" => "Catálogo",
            "fr" => "Catalogue",
            "it" => "Catalogo",
            "ru" => "Каталог",
            "cr" => "Katalog",
            "sb" => "Katalog",
            "du" => "Catalogus"
        ],
        "Develop" => [
            "pt" => "Desenvolver",
            "en" => "Develop",
            "de" => "Entwickeln",
            "es" => "Desarrollar",
            "fr" => "Développer",
            "it" => "Sviluppa",
            "ru" => "Развивать",
            "cr" => "Razvijati",
            "sb" => "Razvij",
            "du" => "Ontwikkelen"
        ],
        "Search" => [
            "pt" => "Procurar",
            "en" => "Search",
            "de" => "Suche",
            "es" => "Buscar",
            "fr" => "Chercher",
            "it" => "Cerca",
            "ru" => "Искать",
            "cr" => "Korisnicima",
            "sb" => "Korisnicima",
            "du" => "Zoeken"
        ],
        " in People" => [
            "pt" => " em Pessoas",
            "en" => " in People",
            "de" => " in Personen",
            "es" => " en Personas",
            "fr" => " dans les Personnes",
            "it" => " nelle Persone",
            "ru" => " в Людях",
            "cr" => " u Ljude",
            "sb" => " u Korisnicima",
            "du" => " in Mensen"
        ],
        " in Games" => [
            "pt" => " em Jogos",
            "en" => " in Games",
            "de" => " in Spielen",
            "es" => " en Juegos",
            "fr" => " dans les Jeux",
            "it" => " nei Giochi",
            "ru" => " в Играх",
            "cr" => " u Igre",
            "sb" => " u Igrama",
            "du" => " in Spellen"
        ],
        " in Catalog" => [
            "pt" => " no Catálogo",
            "en" => " in Catalog",
            "de" => " in Katalog",  
            "es" => " en Catálogo",
            "fr" => " dans le Catalogue",
            "it" => " nel Catalogo",
            "ru" => " в Каталоге",
            "cr" => " u Katalog",
            "sb" => " u Katalogu",
            "du" => " in Catalogus"
        ],
        " in Groups" => [
            "pt" => " em Grupos",
            "en" => " in Groups",
            "de" => " in Gruppen",
            "es" => " en Grupos",
            "fr" => " dans les Groupes",
            "it" => " nei Gruppi",
            "ru" => " в Группах",
            "cr" => " u Grupe",
            "sb" => " u Grupama",
            "du" => " in Groepen"
        ],
        " in Library" => [
            "pt" => " na Biblioteca",
            "en" => " in Library",
            "de" => " in der Bibliothek",
            "es" => " en la Biblioteca",
            "fr" => " dans la Bibliothèque",
            "it" => " nella Libreria",
            "ru" => " в Библиотеке",
            "cr" => " u Biblioteka",
            "sb" => " u Biblioteci",
            "du" => " in Bibliotheek"
        ],
        "Sign Up" => [
            "pt" => "Registrar",
            "en" => "Sign Up",
            "de" => "Registrieren",
            "es" => "Regístrate",
            "fr" => "S'inscrire",
            "it" => "Iscriviti",
            "ru" => "Зарегистрироваться",
            "cr" => "Prijavi se",
            "sb" => "Prijavi se",
            "du" => "Aanmelden"
        ],
        "Log In" => [
            "pt" => "Entrar",
            "en" => "Log In",
            "de" => "Einloggen",
            "es" => "Iniciar sesión",
            "fr" => "Se connecter",
            "it" => "Accedi",
            "ru" => "Войти",
            "cr" => "Prijavi se",
            "sb" => "Prijavi se",
            "du" => "Inloggen"
        ],
        "Settings" => [
            "pt" => "Configurações",
            "en" => "Settings",
            "de" => "Einstellungen",
            "es" => "Configuraciones",
            "fr" => "Paramètres",
            "it" => "Impostazioni",
            "ru" => "Настройки",
            "cr" => "Postavke",
            "sb" => "Podešavanja",
            "du" => "Instellingen"
        ],
        "Help" => [
            "pt" => "Ajuda",
            "en" => "Help",
            "de" => "Helfen",
            "es" => "Ayuda",
            "fr" => "Aider",
            "it" => "Aiuto",
            "ru" => "Помощь",
            "cr" => "Pomoć",
            "sb" => "Pomoć",
            "du" => "Helpen"
        ],
        "Logout" => [
            "pt" => "Sair",
            "en" => "Logout",
            "de" => "Ausloggen",
            "es" => "Cerrar sesión",
            "fr" => "Se déconnecter",
            "it" => "Disconnettersi",
            "ru" => "Выйти",
            "cr" => "Odjava",
            "sb" => "Odjava",
            "du" => "Uitloggen"
        ],
        "Trade Currency" => [
            "pt" => "Troca de Currencia",
            "en" => "Trade Currency",
            "de" => "Handelswährung",
            "es" => "Moneda de intercambio",
            "fr" => "Monnaie d'échange",
            "it" => "Valuta di scambio",
            "ru" => "Торговая валюта",
            "cr" => "Trgovinska valuta",
            "sb" => "Trgovinska valuta",
            "du" => "Handelsvaluta"
        ],
        "Buy ROBUX" => [
            "pt" => "Comprar ROBUX",
            "en" => "Buy ROBUX",
            "de" => "ROBUX kaufen",
            "es" => "Comprar ROBUX",
            "fr" => "Acheter des ROBUX",
            "it" => "Acquista ROBUX",
            "ru" => "Купить ROBUX",
            "cr" => "Kupi ROBUX",
            "sb" => "Kupi ROBUX",
            "du" => "Koop ROBUX"
        ],
        "Home" => [
            "pt" => "Início",
            "en" => "Home",
            "de" => "Startseite",
            "es" => "Inicio",
            "fr" => "Accueil",
            "it" => "Home",
            "ru" => "Главная",
            "cr" => "Početna",
            "sb" => "Početna",
            "du" => "Startpagina"
        ],
        "Profile" => [
            "pt" => "Perfil",
            "en" => "Profile",
            "de" => "Profil",
            "es" => "Perfil",
            "fr" => "Profil",
            "it" => "Profilo",
            "ru" => "Профиль",
            "cr" => "Profil",
            "sb" => "Profil",
            "du" => "Profiel"
        ],
        "Messages" => [
            "pt" => "Mensagens",
            "en" => "Messages",
            "de" => "Nachrichten",
            "es" => "Mensajes",
            "fr" => "Messages",
            "it" => "Messaggi",
            "ru" => "Сообщения",
            "cr" => "Poruke",
            "sb" => "Poruke",
            "du" => "Berichten"
        ],
        "Friends" => [
            "pt" => "Amigos",
            "en" => "Friends",
            "de" => "Freundschaft",
            "es" => "Amigos",
            "fr" => "Amis",
            "it" => "Amici",
            "ru" => "Друзья",
            "cr" => "Prijatelji",
            "sb" => "Prijatelji",
            "du" => "Vrienden"
        ],
        "Character" => [
            "pt" => "Personagem",
            "en" => "Character",
            "de" => "Charakter",
            "es" => "Personaje",
            "fr" => "Personnage",
            "it" => "Personaggio",
            "ru" => "Персонаж",
            "cr" => "Karakter",
            "sb" => "Karakter",
            "du" => "Karakter"
        ],
        "Inventory" => [
            "pt" => "Inventário",
            "en" => "Inventory",
            "de" => "Inventar",
            "es" => "Inventario",
            "fr" => "Inventaire",
            "it" => "Inventario",
            "ru" => "Инвентарь",
            "cr" => "Inventar",
            "sb" => "Inventar",
            "du" => "Inventaris"
        ],
        "Trade" => [
            "pt" => "Trocar",
            "en" => "Trade",
            "de" => "Handel",
            "es" => "Comercio",
            "fr" => "Commerce",
            "it" => "Commercio",
            "ru" => "Торговля",
            "cr" => "Razmeni",
            "sb" => "Razmeni",
            "du" => "Handel"
        ],
        "Groups" => [
            "pt" => "Grupos",
            "en" => "Groups",
            "de" => "Gruppen",
            "es" => "Grupos",
            "fr" => "Groupes",
            "it" => "Gruppi",
            "ru" => "Группы",
            "cr" => "Grupe",
            "sb" => "Grupe",
            "du" => "Groepen"
        ],
        "Upgrade Now" => [
            "pt" => "Atualizar Agora",
            "en" => "Upgrade Now",
            "de" => "Jetzt upgraden",
            "es" => "Actualizar Ahora",
            "fr" => "Mettre à niveau maintenant",
            "it" => "Aggiorna ora",
            "ru" => "Обновить сейчас",
            "cr" => "Nadogradi sada",
            "sb" => "Nadogradi sada",
            "du" => "Nu upgraden"
        ],
        // bottom header
    ];
       public static function render(): string
    {
        global $site_properties;
        // do not render the header if we are accessing the site from an inherited Roblox/ useragent:
        if(isset($_SERVER['HTTP_USER_AGENT']) && str_contains(strtolower($_SERVER['HTTP_USER_AGENT']), 'roblox/')){
            return "";
        }
        $user = Auth::GetAuthenticatedUser();
        if (!$user) {
            $nav = new NavBarItems();
            $nav->cssClass = "nav rbx-navbar hidden-xs hidden-sm col-md-4 col-lg-3";
            $nav->addItem(new NavBarItem("Games", "/games"));
            $nav->addItem(new NavBarItem("Catalog", "/catalog"));
            $nav->addItem(new NavBarItem("Develop", "/develop"));
            $nav->addItem(new NavBarItem("ROBUX", "/upgrades/robux", "buy-robux"));

            $headerPanel = new Panel("header");
            $headerPanel->cssClass = "navbar-fixed-top rbx-header";

            $scriptTag = '<script type="text/javascript" src="//js.rbxcdn.com/9715e76471ffacd5f6d9c24a5ab101ad.js"></script>';

            $headerPanel->addChild(<<<HTML
                <div class="container-fluid">
                    <div class="rbx-navbar-header">
                        <div data-behavior="nav-notification" class="rbx-nav-collapse" onselectstart="return false;"></div>
                        <div class="navbar-header">
                            <a class="navbar-brand" href="/"><span class="logo"></span></a>
                        </div>
                    </div>
            HTML
            );

            $headerPanel->addChild($nav->render());

            $headerPanel->addChild(<<<HTML
                <div id="navbar-universal-search" class="navbar-left rbx-navbar-search col-xs-5 col-sm-6 col-md-3" data-behavior="univeral-search" role="search">
                    <div class="input-group rbx-input-group">
                        <input id="navbar-search-input" class="form-control rbx-input-field" type="text" placeholder="Search" maxlength="120" />
                        <div class="input-group-btn rbx-input-group-btn">
                            <button id="navbar-search-btn" class="rbx-input-addon-btn" type="submit">
                                <span class="rbx-icon-nav-search"></span>
                            </button>
                        </div>
                    </div>
                    <ul data-toggle="dropdown-menu" class="rbx-dropdown-menu" role="menu">
                        <li class="rbx-navbar-search-option selected" data-searchurl="/users/search?keyword=">
                            <span class="rbx-navbar-search-text">Search <span class="rbx-navbar-search-string"></span> in People</span>
                        </li>
                        <li class="rbx-navbar-search-option" data-searchurl="/games/?Keyword=">
                            <span class="rbx-navbar-search-text">Search <span class="rbx-navbar-search-string"></span> in Games</span>
                        </li>
                        <li class="rbx-navbar-search-option" data-searchurl="/catalog/browse.aspx?CatalogContext=1&amp;Keyword=">
                            <span class="rbx-navbar-search-text">Search <span class="rbx-navbar-search-string"></span> in Catalog</span>
                        </li>
                        <li class="rbx-navbar-search-option" data-searchurl="/groups/search.aspx?val=">
                            <span class="rbx-navbar-search-text">Search <span class="rbx-navbar-search-string"></span> in Groups</span>
                        </li>
                        <li class="rbx-navbar-search-option" data-searchurl="/develop/library?CatalogContext=2&amp;Category=6&amp;Keyword=">
                            <span class="rbx-navbar-search-text">Search <span class="rbx-navbar-search-string"></span> in Library</span>
                        </li>
                    </ul>
                </div>
            HTML
            );
            
            $headerPanel->addChild(<<<HTML
                <div class="navbar-right rbx-navbar-right col-xs-4 col-sm-3">
                    <ul class="nav navbar-right rbx-navbar-right-nav" data-display-opened="False">
                        <li><a id="header-login" class="rbx-navbar-login" data-behavior="login">Log In</a></li>
                        <div id="iFrameLogin" class="rbx-popover-content" data-toggle="popover-login" role="menu">
                            <iframe class="rbx-navbar-login-iframe" src="/Login/iFrameLogin.aspx?loginRedirect=True" scrolling="no" frameborder="0" width="320"></iframe>
                        </div>
                        <li><a class="rbx-navbar-signup" href="/Login/NewAge.aspx">Sign Up</a></li>
                        <li class="rbx-navbar-right-search" data-toggle="toggle-search"><a class="rbx-menu-icon"><span class="rbx-icon-nav-search-white"></span></a></li>
                    </ul>
                </div>
            HTML
            );
            $nav = new NavBarItems();
            $nav->cssClass = "nav rbx-navbar hidden-md hidden-lg col-xs-12";
            $nav->addItem(new NavBarItem("Games", "/games"));
            $nav->addItem(new NavBarItem("Catalog", "/catalog"));
            $nav->addItem(new NavBarItem("Develop", "/develop"));
            $nav->addItem(new NavBarItem("ROBUX", "/upgrades/robux", "buy-robux"));
            $headerPanel->addChild("" . $nav->render() .  <<<HTML
                </div> <!--container-fluid-->
            HTML
            );

            return $scriptTag . $headerPanel->render();
        }

        $translated_labels = self::$translated_labels;
        $userInfo = $user;
        $username = htmlspecialchars($userInfo["username"] ?? '', ENT_QUOTES, 'UTF-8');
        $userId = (int)($userInfo["id"] ?? 0);

        $userbalance = new UserBalance($userId);
        $tickets = $userbalance->GetTicketsBalance();
        $robux = $userbalance->GetRobuxBalance();

        $lang = $userInfo['language'] ?? "en";

        $formatNumber = function ($number) {
            if ($number >= 1000000000000) return round($number / 1000000000000, 1) . 'T';
            if ($number >= 1000000000)    return round($number / 1000000000, 1) . 'B';
            if ($number >= 1000000)       return round($number / 1000000, 1) . 'M';
            if ($number >= 1000)          return round($number / 1000, 1) . 'K';
            return $number;
        };

        $formated_t = $formatNumber($tickets);
        $formated_r = $formatNumber($robux);

        $scriptTag = '<script type="text/javascript" src="//js.rbxcdn.com/9715e76471ffacd5f6d9c24a5ab101ad.js"></script>';

        $headerPanel = new Panel("header");
        $headerPanel->cssClass = "navbar-fixed-top rbx-header";

        $headerPanel->addChild(<<<HTML
            <div class="container-fluid">
                <div class="rbx-navbar-header">
                    <div data-behavior="nav-notification" class="rbx-nav-collapse" onselectstart="return false;">
                        <span class="rbx-icon-nav-menu"></span>
                        <div class="rbx-nav-notification hide rbx-font-xs" title="0"></div>
                    </div>
                    <div class="navbar-header">
                        <a class="navbar-brand" href="/"><span class="logo"></span></a>
                    </div>
                </div>
        HTML
        );

        $nav = new NavBarItems();
        $nav->cssClass = "nav rbx-navbar hidden-xs hidden-sm col-md-4 col-lg-3";
        $nav->addItem(new NavBarItem($translated_labels['Games'][$lang], "/games"));
        $nav->addItem(new NavBarItem($translated_labels['Catalog'][$lang], "/catalog"));
        $nav->addItem(new NavBarItem($translated_labels['Develop'][$lang], "/develop"));
        $nav->addItem(new NavBarItem("ROBUX", "/upgrades/robux?ctx=nav", "buy-robux"));
        $headerPanel->addChild($nav->render());

        $headerPanel->addChild(<<<HTML
            <div id="navbar-universal-search" class="navbar-left rbx-navbar-search col-xs-5 col-sm-6 col-md-3" data-behavior="univeral-search" role="search">
                <div class="input-group rbx-input-group">
                    <input id="navbar-search-input" class="form-control rbx-input-field" type="text" placeholder="{$translated_labels['Search'][$lang]}" maxlength="120" />
                    <div class="input-group-btn rbx-input-group-btn">
                        <button id="navbar-search-btn" class="rbx-input-addon-btn" type="submit">
                            <span class="rbx-icon-nav-search"></span>
                        </button>
                    </div>
                </div>
                <ul data-toggle="dropdown-menu" class="rbx-dropdown-menu" role="menu">
                    <li class="rbx-navbar-search-option selected" data-searchurl="/search/users?keyword=">
                        <span class="rbx-navbar-search-text">{$translated_labels['Search'][$lang]} <span class="rbx-navbar-search-string"></span>{$translated_labels[' in People'][$lang]}</span>
                    </li>
                    <li class="rbx-navbar-search-option" data-searchurl="/games/?Keyword=">
                        <span class="rbx-navbar-search-text">{$translated_labels['Search'][$lang]} <span class="rbx-navbar-search-string"></span>{$translated_labels[' in Games'][$lang]}</span>
                    </li>
                    <li class="rbx-navbar-search-option" data-searchurl="/catalog/browse.aspx?CatalogContext=1&amp;Keyword=">
                        <span class="rbx-navbar-search-text">{$translated_labels['Search'][$lang]} <span class="rbx-navbar-search-string"></span>{$translated_labels[' in Catalog'][$lang]}</span>
                    </li>
                    <li class="rbx-navbar-search-option" data-searchurl="/groups/search.aspx?val=">
                        <span class="rbx-navbar-search-text">{$translated_labels['Search'][$lang]} <span class="rbx-navbar-search-string"></span>{$translated_labels[' in Groups'][$lang]}</span>
                    </li>
                    <li class="rbx-navbar-search-option" data-searchurl="/develop/library?CatalogContext=2&amp;Category=6&amp;Keyword=">
                        <span class="rbx-navbar-search-text">{$translated_labels['Search'][$lang]} <span class="rbx-navbar-search-string"></span>{$translated_labels[' in Library'][$lang]}</span>
                    </li>
                </ul>
            </div>
        HTML
        );
        $headerPanel->addChild(<<<HTML
            <div class="navbar-right rbx-navbar-right col-xs-4 col-sm-3">
                <ul class="nav navbar-right rbx-navbar-icon-group">
                    <li>
                        <a class="rbx-menu-item" data-toggle="popover" data-bind="popover-setting" data-viewport="#header">
                            <span class="rbx-icon-nav-settings" id="nav-settings"></span>
                            <span class="rbx-font-xs nav-setting-highlight hidden">0</span>
                        </a>
                        <div class="rbx-popover-content" data-toggle="popover-setting">
                            <ul class="rbx-dropdown-menu" role="menu">
                                <li><a class="rbx-menu-item" href="/my/account">{$translated_labels['Settings'][$lang]}<span class="rbx-font-xs nav-setting-highlight hidden">0</span></a></li>
                                <li><a href="/Help/Builderman.aspx" target="_blank">{$translated_labels['Help'][$lang]}</a></li>
                                <li><a data-behavior="logout" data-bind="/authentication/logout">{$translated_labels['Logout'][$lang]}</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a class="rbx-menu-item" data-toggle="popover" data-bind="popover-tix" data-viewport="#header">
                            <span class="rbx-icon-nav-tix" id="nav-tix"></span>
                            <span class="rbx-text-navbar-right" id="nav-tix-amount">{$formated_t}</span>
                        </a>
                        <div class="rbx-popover-content" data-toggle="popover-tix">
                            <ul class="rbx-dropdown-menu" role="menu">
                                <li><a href="/My/Money.aspx#/#Summary_tab" id="nav-tix-balance">{$tickets} Tickets</a></li>
                                <li><a href="/my/money.aspx?tab=TradeCurrency">{$translated_labels['Trade Currency'][$lang]}</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a id="nav-robux-icon" class="rbx-menu-item" data-toggle="popover" data-bind="popover-robux">
                            <span class="rbx-icon-nav-robux" id="nav-robux"></span>
                            <span class="rbx-text-navbar-right" id="nav-robux-amount">{$formated_r}</span>
                        </a>
                        <div class="rbx-popover-content" data-toggle="popover-robux">
                            <ul class="rbx-dropdown-menu" role="menu">
                                <li><a href="/My/Money.aspx#/#Summary_tab" id="nav-robux-balance">{$robux} ROBUX</a></li>
                                <li><a href="/upgrades/robux?ctx=navpopover">{$translated_labels['Buy ROBUX'][$lang]}</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="rbx-navbar-right-search" data-toggle="toggle-search">
                        <a class="rbx-menu-icon"><span class="rbx-icon-nav-search-white"></span></a>
                    </li>
                </ul>
            </div>
        HTML
        );
        $nav = new NavBarItems();
            $nav->cssClass = "nav rbx-navbar hidden-md hidden-lg col-xs-12";
            $nav->addItem(new NavBarItem("Games", "/games"));
            $nav->addItem(new NavBarItem("Catalog", "/catalog"));
            $nav->addItem(new NavBarItem("Develop", "/develop"));
            $nav->addItem(new NavBarItem("ROBUX", "/upgrades/robux", "buy-robux"));
        $headerPanel->addChild("" . $nav->render() .  <<<HTML
            </div> <!--container-fluid-->
        HTML
        );

        $leftNavHtml = <<<HTML
        <!-- LEFT NAV MENU -->
        <div id="navigation" class="rbx-left-col" data-behavior="left-col">
            <ul>
                <li class="rbx-lead"><a href="/user.aspx">{$username}</a></li>
                <li class="rbx-divider"></li>
            </ul>
            <div class="rbx-scrollbar" data-toggle="scrollbar" onselectstart="return false;">
                <ul>
                    <li><a href="/home" id="nav-home"><span class="rbx-icon-nav-home"></span><span>{$translated_labels['Home'][$lang]}</span></a></li>
                    <li><a href="/User.aspx?ID={$userId}" id="nav-profile"><span class="rbx-icon-nav-profile"></span><span>{$translated_labels['Profile'][$lang]}</span></a></li>
                    <li><a href="/my/messages/#!/inbox" id="nav-message" data-count="0"><span class="rbx-icon-nav-message"></span><span>{$translated_labels['Messages'][$lang]}</span><span class="rbx-highlight" title="0"></span></a></li>
                    <li><a href="/friends.aspx" id="nav-friends" data-count="0"><span class="rbx-icon-nav-friends"></span><span>{$translated_labels['Friends'][$lang]}</span><span class="rbx-highlight" title="0"></span></a></li>
                    <li><a href="/My/Character.aspx" id="nav-character"><span class="rbx-icon-nav-charactercustomizer"></span><span>{$translated_labels['Character'][$lang]}</span></a></li>
                    <li><a href="/My/Stuff.aspx" id="nav-inventory"><span class="rbx-icon-nav-inventory"></span><span>{$translated_labels['Inventory'][$lang]}</span></a></li>
                    <li><a href="/My/Money.aspx#/#TradeItems_tab" id="nav-trade"><span class="rbx-icon-nav-trade"></span><span>{$translated_labels['Trade'][$lang]}</span></a></li>
                    <li><a href="/My/Groups.aspx" id="nav-group"><span class="rbx-icon-nav-group"></span><span>{$translated_labels['Groups'][$lang]}</span></a></li>
                    <li><a href="/Forum/default.aspx" id="nav-forum"><span class="rbx-icon-nav-forum"></span><span>Forum</span></a></li>
                    <li><a href="http://blog.{$site_properties['hostname']}" id="nav-blog"><span class="rbx-icon-nav-blog"></span><span>Blog</span></a></li>
                    <li class="rbx-upgrade-now"><a href="/Upgrades/BuildersClubMemberships.aspx?ctx=leftnav" class="rbx-btn-secondary-xs" id="upgrade-now-button">{$translated_labels['Upgrade Now'][$lang]}</a></li>
                </ul>
            </div>
        </div>
        HTML;

        return $scriptTag . $headerPanel->render() . $leftNavHtml;
    }
}

class SiteFooter{
    private bool $isAuthenticated;
    public static function render()
    {
        global $site_properties;
        $host = htmlspecialchars($site_properties["hostname"]);
        if(!Auth::GetAuthenticatedUser()){
            return <<<HTML
            <div id="Footer" class="footer-container">
            <div class="FooterNav">
        <a href="/info/Privacy.aspx">Privacy Policy</a>
        &nbsp;|&nbsp; 
        <a href="http://corp.' . host . '/advertise-on-roblox" class="roblox-interstitial">Advertise with Us</a>
        &nbsp;|&nbsp; 
        <a href="http://corp.' . host . '/roblox-press" class="roblox-interstitial">Press</a>
        &nbsp;|&nbsp; 
        <a href="http://corp.' . host . '/contact-us" class="roblox-interstitial">Contact Us</a>
        &nbsp;|&nbsp;
        <a href="http://corp.' . host . '/" class="roblox-interstitial">About Us</a>
        &nbsp;|&nbsp;
        <a href="http://blog.' . host . '" class="roblox-interstitial">Blog</a>
        &nbsp;|&nbsp;
        <a href="http://corp.' . host . '/jobs" class="roblox-interstitial">Jobs</a>
        &nbsp;|&nbsp;
        <a href="http://corp.' . host . '/parents" class="roblox-interstitial">Parents</a>
            </div>
            <div class="FooterNav">
        <div id="SEOGenreLinks" class="SEOGenreLinks">
                  <a href="/all-games">All Games</a> 
                      <span>|</span>
                  <a href="/building-games">Building</a> 
                      <span>|</span>
                  <a href="/horror-games">Horror</a> 
                      <span>|</span>
                  <a href="/town-and-city-games">Town and City</a> 
                      <span>|</span>
                  <a href="/military-games">Military</a> 
                      <span>|</span>
                  <a href="/comedy-games">Comedy</a> 
                      <span>|</span>
                  <a href="/medieval-games">Medieval</a> 
                      <span>|</span>
                  <a href="/adventure-games">Adventure</a> 
                      <span>|</span>
                  <a href="/sci-fi-games">Sci-Fi</a> 
                      <span>|</span>
                  <a href="/naval-games">Naval</a> 
                      <span>|</span>
                  <a href="/fps-games">FPS</a> 
                      <span>|</span>
                  <a href="/rpg-games">RPG</a> 
                      <span>|</span>
                  <a href="/sports-games">Sports</a> 
                      <span>|</span>
                  <a href="/fighting-games">Fighting</a> 
                      <span>|</span>
                  <a href="/western-games">Western</a> 

        </div>
            </div>
            <div class="legal">
                <div class="left">
                    <div id="a15b1695-1a5a-49a9-94f0-9cd25ae6c3b2">
            <a href="//privacy.truste.com/privacy-seal/Roblox-Corporation/validation?rid=2428aa2a-f278-4b6d-9095-98c4a2954215" title="TRUSTe Children privacy certification" target="_blank">
                <img style="border: none" src="/Images/TRUSTe/seal.png" width="133" height="45" alt="TRUSTe Children privacy certification"/>
            </a>
        </div>
        </div>
        <div class="right">
            <p class="Legalese">
            RBLXLocal, "Online Building Toy", characters, logos, names, and all related indicia are trademarks of <a href="http://corp.roblox.com/" ref="footer-smallabout" class="roblox-interstitial">ROBLOX Corporation</a>, ©2025. Patents pending.
           RBLXLocal is not sponsored, authorized or endorsed by any producer of plastic building bricks, including The LEGO Group, MEGA Brands, and K'Nex, even the Roblox Platform. Use of this site signifies your acceptance of the <a href="/info/terms-of-service" ref="footer-terms">Terms and Conditions</a>.
        </p>
        </div>
        <div class="clear"></div>
            </div>
        </div>    </div>

        </div> 
        </div> 
        </div> 
        </div> 


        <div id="ChatContainer" style="position:fixed; bottom:0; right:0; z-index:10020;">


        </div>


            <script type="text/javascript">function urchinTracker() {}</script>


        <div id="PlaceLauncherStatusPanel" style="display:none;width:300px">
            <div class="modalPopup blueAndWhite PlaceLauncherModal" style="min-height: 160px">
                <div id="Spinner" class="Spinner" style="margin:0 1em 1em 0; padding:20px 0;">
                    <img src="https://s3.amazonaws.com/images.' . host . '/e998fb4c03e8c2e30792f2f3436e9416.gif" height="32" width="32" alt="Progress" />
                </div>
                <div id="status" style="min-height:40px;text-align:center;margin:5px 20px">
                    <div id="Starting" class="PlaceLauncherStatus MadStatusStarting" style="display:block">
                        Starting Roblox...
                    </div>
                    <div id="Waiting" class="PlaceLauncherStatus MadStatusField">Connecting to Players...</div>
                    <div id="StatusBackBuffer" class="PlaceLauncherStatus PlaceLauncherStatusBackBuffer MadStatusBackBuffer"></div>
                </div>
                <div style="text-align:center;margin-top:1em">
                    <input type="button" class="Button CancelPlaceLauncherButton translate" value="Cancel" />
                </div>
            </div>
        </div>



        <script type='text/javascript' src='https://s3.amazonaws.com/js.roblox.com/507606ba77acf2ff29dd3ec7cb668f06.js'></script>

            <div id="videoPrerollPanel" style="display:none">
                <div id="videoPrerollTitleDiv">
                    Gameplay sponsored by:
                </div>
                <div id="videoPrerollMainDiv"></div>
                <div id="videoPrerollCompanionAd"></div>
                <div id="videoPrerollLoadingDiv">
                    Loading <span id="videoPrerollLoadingPercent">0%</span> - <span id="videoPrerollMadStatus" class="MadStatusField">Starting game...</span><span id="videoPrerollMadStatusBackBuffer" class="MadStatusBackBuffer"></span>
                    <div id="videoPrerollLoadingBar">
                        <div id="videoPrerollLoadingBarCompleted">
                        </div>
                    </div>
                </div>
                <div id="videoPrerollJoinBC">
                    <span>Get more with Builders Club!</span>
                    <a href="/Upgrades/BuildersClubMemberships.aspx?ref=vpr" target="_blank" id="videoPrerollJoinBCButton"></a>
                </div>
            </div>
            <script type="text/javascript">
                Roblox.VideoPreRoll.showVideoPreRoll = false;
                Roblox.VideoPreRoll.loadingBarMaxTime = 33000;
                Roblox.VideoPreRoll.videoOptions.key = "robloxcorporation";
                Roblox.VideoPreRoll.videoOptions.categories = "NonBC,IsLoggedIn,AgeUnknown,GenderUnknown";
                     Roblox.VideoPreRoll.videoOptions.id = "games";
                Roblox.VideoPreRoll.videoLoadingTimeout = 11000;
                Roblox.VideoPreRoll.videoPlayingTimeout = 41000;
                Roblox.VideoPreRoll.videoLogNote = "NotWindows";
                Roblox.VideoPreRoll.logsEnabled = true;
                Roblox.VideoPreRoll.excludedPlaceIds = "32373412";

                        Roblox.VideoPreRoll.specificAdOnPlacePageEnabled = true;
                        Roblox.VideoPreRoll.specificAdOnPlacePageId = 57507247;
                        Roblox.VideoPreRoll.specificAdOnPlacePageCategory = "stooges";


                        Roblox.VideoPreRoll.specificAdOnPlacePage2Enabled = true;
                        Roblox.VideoPreRoll.specificAdOnPlacePage2Id = 122911678;
                        Roblox.VideoPreRoll.specificAdOnPlacePage2Category = "lego";

                $(Roblox.VideoPreRoll.checkEligibility);
            </script>


        <div id="GuestModePrompt_BoyGirl" class="Revised GuestModePromptModal" style="display:none;">
            <div class="simplemodal-close">
                <a class="ImageButton closeBtnCircle_20h" style="cursor: pointer; margin-left:455px;top:7px; position:absolute;"></a>
            </div>
            <div class="Title">
                Choose Your Character
            </div>
            <div style="min-height: 275px; background-color: white;">
                <div style="clear:both; height:25px;"></div>

                <div style="text-align: center;">
                    <div class="VisitButtonsGuestCharacter VisitButtonBoyGuest" style="float:left; margin-left:45px;"></div>
                    <div class="VisitButtonsGuestCharacter VisitButtonGirlGuest" style="float:right; margin-right:45px;"></div>
                </div>
                <div style="clear:both; height:25px;"></div>
                <div class="RevisedFooter" >
                    <div style="width:200px;margin:10px auto 0 auto;">
                        <a href="#" onclick="redirectPlaceLauncherToRegister(); return false;"><div class="RevisedCharacterSelectSignup"></div></a>
                        <a class="HaveAccount" href="#" onclick="redirectPlaceLauncherToLogin();return false;">I have an account</a>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            function checkRobloxInstall() {
                         window.location= '/install/unsupported.aspx'; return false;
            }
                if (typeof MadStatus === "undefined") {
                    MadStatus = {};
                }
            
                MadStatus.Resources = {
                    //<sl:translate>
                    accelerating: "Accelerating",
                    aggregating: "Aggregating",
                    allocating: "Allocating",
                    acquiring: "Acquiring",
                    automating: "Automating",
                    backtracing: "Backtracing",
                    bloxxing: "Bloxxing",
                    bootstrapping: "Bootstrapping",
                    calibrating: "Calibrating",
                    correlating: "Correlating",
                    denoobing: "De-noobing",
                    deionizing: "De-ionizing",
                    deriving: "Deriving",
                    energizing: "Energizing",
                    filtering: "Filtering",
                    generating: "Generating",
                    indexing: "Indexing",
                    loading: "Loading",
                    noobing: "Noobing",
                    optimizing: "Optimizing",
                    oxidizing: "Oxidizing",
                    queueing: "Queueing",
                    parsing: "Parsing",
                    processing: "Processing",
                    rasterizing: "Rasterizing",
                    reading: "Reading",
                    registering: "Registering",
                    rerouting: "Re-routing",
                    resolving: "Resolving",
                    sampling: "Sampling",
                    updating: "Updating",
                    writing: "Writing",
                    blox: "Blox",
                    countzero: "Count Zero",
                    cylon: "Cylon",
                    data: "Data",
                    ectoplasm: "Ectoplasm",
                    encryption: "Encryption",
                    event: "Event",
                    farnsworth: "Farnsworth",
                    bebop: "Bebop",
                    fluxcapacitor: "Flux Capacitor",
                    fusion: "Fusion",
                    game: "Game",
                    gibson: "Gibson",
                    host: "Host",
                    mainframe: "Mainframe",
                    metaverse: "Metaverse",
                    nerfherder: "Nerf Herder",
                    neutron: "Neutron",
                    noob: "Noob",
                    photon: "Photon",
                    profile: "Profile",
                    script: "Script",
                    skynet: "Skynet",
                    tardis: "TARDIS",
                    virtual: "Virtual",
                    analogs: "Analogs",
                    blocks: "Blocks",
                    cannon: "Cannon",
                    channels: "Channels",
                    core: "Core",
                    database: "Database",
                    dimensions: "Dimensions",
                    directives: "Directives",
                    engine: "Engine",
                    files: "Files",
                    gear: "Gear",
                    index: "Index",
                    layer: "Layer",
                    matrix: "Matrix",
                    paradox: "Paradox",
                    parameters: "Parameters",
                    parsecs: "Parsecs",
                    pipeline: "Pipeline",
                    players: "Players",
                    ports: "Ports",
                    protocols: "Protocols",
                    reactors: "Reactors",
                    sphere: "Sphere",
                    spooler: "Spooler",
                    stream: "Stream",
                    switches: "Switches",
                    table: "Table",
                    targets: "Targets",
                    throttle: "Throttle",
                    tokens: "Tokens",
                    torpedoes: "Torpedoes",
                    tubes: "Tubes"
                    //</sl:translate>
                };
        </script>

            
        <div id="InstallationInstructions"  class="modalPopup blueAndWhite" style="display:none;overflow:hidden" >
            <a id="CancelButton2" onclick="return Roblox.Client._onCancel();" class="ImageButton closeBtnCircle_35h ABCloseCircle"></a>
            <div style="padding-bottom:10px;text-align:center">
                <br /><br />
            </div>
        </div>
            
            
            
        <div id="pluginObjDiv" style="height:1px;width:1px;visibility:hidden;position: absolute;top: 0;"></div>
        <iframe id="downloadInstallerIFrame" style="visibility:hidden;height:0;width:1px;position:absolute"></iframe>
            
            
        <script type='text/javascript' src='https://s3.amazonaws.com/js.roblox.com/d387e54149ead170a1a8d204d0e7f1ed.js'></script>
            
        <script type="text/javascript">
            Roblox.Client._skip = '/install/unsupported.aspx';
            Roblox.Client._CLSID = '';
            Roblox.Client._installHost = '';
            Roblox.Client.ImplementsProxy = false;
            Roblox.Client._silentModeEnabled = false;
            Roblox.Client._bringAppToFrontEnabled = false;
            
                 Roblox.Client._installSuccess = function() { GoogleAnalyticsEvents && GoogleAnalyticsEvents.ViewVirtual('InstallSuccess'); };
            </script>

        HTML;
        }else{
            $user = Auth::GetAuthenticatedUserInfo();
            $username = htmlspecialchars($user["username"], ENT_QUOTES, 'UTF-8');
            $userId = (int)$user["id"];
            $tickets = htmlspecialchars($user["tickets"], ENT_QUOTES, 'UTF-8');
            $robux = htmlspecialchars($user["robux"], ENT_QUOTES, 'UTF-8');
            $js_party_val = "<script type=\"text/javascript\" language=\"javascript\">
                        Party.CurrentUserID = {$userId};
                        Party.CurrentUserName = \"{$username}\";
                        Party.ActiveView = \"\";
                        Party.PollThreadAvailable = true;
                        Party.FirstLoad = true;
                        Party.PollIntervalTimer = null;
                        Party.Cookie = new RobloxJSONCookie(\"PartyCookie\"); 
                        Party.MaxPartySize = 6;
                        Party.PlayEnabled = true;
                        
                        Party.Resources = {
                            areYouSureReport: 'Are you sure you would like to report '
                            , report: \"Report\"
                            , kick: \"Kick\"
                            , pending: \"Pending...\"
                            , partyInvite: \"Party Invite!\"
                            , partyGameBlurb: \"When the party leader joins a game, the rest of the party will be invited to follow\"
                            , inviteInstructions: \"Please type the name of the user you wish to invite\"
                            , partyFull: \"Your party is already full!\"
                            , joinConfirm1: \"The party leader has joined \"
                            , joinConfirm2: \".  Would you like to join?\"
                            , joinConfirm3: \"You will be removed from any game you might be playing.\"
                            , enterUserName: 'Enter username'
                        };
                    </script>";
            $js_chat_info_val = "<script type=\"text/javascript\" language=\"javascript\">
                            if (typeof Roblox === \"undefined\") {
                        Roblox = {};
                        }
                        if (typeof Roblox.Chat_v1 === \"undefined\") {
                            Roblox.Chat_v1 = {};
                        }
                        Roblox.Chat_v1.Resources = {
                            //<sl:translate>
                            reportConfirm: 'Are you sure you would like to report this user?'
                            , sendPersonalMessage1: 'This user cannot receive chat messages.  Send them a '
                            , sendPersonalMessage2: 'Personal Message'
                            , loadingChat: 'Loading Chat'
                            , offline: 'Offline'
                            , online: 'Online'
                            , newMessage: 'New Message!'
                            , newMessages: 'New Messages!'
                            //</sl:translate>
                        };
                            
                        ChatBar.FriendsEnabled = 'True';
                        ChatBar.BestFriendsEnabled = 'True';
                        ChatBar.PartyEnabled = 'True';
                        ChatBar.MyUserName = \"{$username}\";
                        ChatBar.MaxChatWindows = 4;
                        ChatBar.ChatPollInterval = 4000;
                        ChatBar.IdleChatPollInterval = ChatBar.ChatPollInterval * ChatBar.PollIntervalFactorForIdle;
                        ChatBar.FriendsPollInterval = 40000;
                        ChatBar.BestFriendsPollInterval = 30000;
                        ChatBar.RecentsPollInterval = 32000;
                        ChatBar.ChatReceivedSoundFile = \"/chat/sound/chatsound.mp3\";
                        ChatBar.ChatNotificationsSetting = 'All';
                        ChatBar.DiagnosticsEnabled = false;
                    
                        $(function()
                        {
                            try
                            {
                                ChatBar.OnPageLoad();
                            }
                            catch (x) { }
                        });
                    </script>";
$html = <<<HTML
               <div id="Footer" class="footer-container">
                    <div class="FooterNav">
                        <a href="http://www.roblox.com/info/Privacy.aspx"><b>Privacy Policy</b></a>
                        &nbsp;|&nbsp; 
                        <a href="http://corp.roblox.com/advertise-on-roblox" class="roblox-interstitial">Advertise with Us</a>
                        &nbsp;|&nbsp; 
                        <a href="http://corp.roblox.com/roblox-press" class="roblox-interstitial">Press</a>
                        &nbsp;|&nbsp; 
                        <a href="http://corp.roblox.com/contact-us" class="roblox-interstitial">Contact Us</a>
                        &nbsp;|&nbsp;
                        <a href="http://corp.roblox.com/" class="roblox-interstitial">About Us</a>
                        &nbsp;|&nbsp;
                        <a href="http://blog.roblox.com/" class="roblox-interstitial">Blog</a>
                        &nbsp;|&nbsp;
                        <a href="http://corp.roblox.com/jobs" class="roblox-interstitial">Jobs</a>
                        &nbsp;|&nbsp;
                        <a href="http://www.roblox.com/Parents.aspx">Parents</a>
                        &nbsp;|&nbsp;
                        <a href="http://shop.roblox.com/" class="roblox-interstitial">Shop</a>
                    </div>
                    <div class="FooterNav">
                        <div id="SEOGenreLinks" class="SEOGenreLinks">
                                  <a href="http://www.roblox.com/all-games">All Games</a> 
                                      <span>|</span>
                                  <a href="http://www.roblox.com/building-games">Building</a> 
                                      <span>|</span>
                                  <a href="http://www.roblox.com/horror-games">Horror</a> 
                                      <span>|</span>
                                  <a href="http://www.roblox.com/town-and-city-games">Town and City</a> 
                                      <span>|</span>
                                  <a href="http://www.roblox.com/military-games">Military</a> 
                                      <span>|</span>
                                  <a href="http://www.roblox.com/comedy-games">Comedy</a> 
                                      <span>|</span>
                                  <a href="http://www.roblox.com/medieval-games">Medieval</a> 
                                      <span>|</span>
                                  <a href="http://www.roblox.com/adventure-games">Adventure</a> 
                                      <span>|</span>
                                  <a href="http://www.roblox.com/sci-fi-games">Sci-Fi</a> 
                                      <span>|</span>
                                  <a href="http://www.roblox.com/naval-games">Naval</a> 
                                      <span>|</span>
                                  <a href="http://www.roblox.com/fps-games">FPS</a> 
                                      <span>|</span>
                                  <a href="http://www.roblox.com/rpg-games">RPG</a> 
                                      <span>|</span>
                                  <a href="http://www.roblox.com/sports-games">Sports</a> 
                                      <span>|</span>
                                  <a href="http://www.roblox.com/fighting-games">Fighting</a> 
                                      <span>|</span>
                                  <a href="http://www.roblox.com/western-games">Western</a> 
                        </div>
                    </div>
                    <div class="legal">
                        <div class="left">
                            <div id="a15b1695-1a5a-49a9-94f0-9cd25ae6c3b2">
                    <a href="http://privacy.truste.com/privacy-seal/Roblox-Corporation/validation?rid=2428aa2a-f278-4b6d-9095-98c4a2954215" title="TRUSTe Children privacy certification" target="_blank">
                        <img style="border: none" src="/Images/TRUSTe/seal.png" alt="TRUSTe Children privacy certification">
                    </a>
                </div>
                        </div>
                        <div class="right">
                            <p class="Legalese">
            RBLXLocal, "Online Building Toy", characters, logos, names, and all related indicia are trademarks of <a href="http://corp.roblox.com/" ref="footer-smallabout" class="roblox-interstitial">ROBLOX Corporation</a>, ©2025. Patents pending.
            RBLXLocal is not sponsored, authorized or endorsed by any producer of plastic building bricks, including The LEGO Group, MEGA Brands, and K'Nex, even the Roblox Platform. Use of this site signifies your acceptance of the <a href="/info/terms-of-service" ref="footer-terms">Terms and Conditions</a>.
                </p>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
                    
                    </div>
                    
                </div>
                <script type="text/javascript" src="https://js.rbxcdn.com/f6ebdcdab40c43bb18d29009ce0880be.js.gzip"></script>
                <script type="text/javascript" src="https://js.rbxcdn.com/32159205207304027c7e0aa4dd329d32.js.gzip"></script>
                <div id="ChatContainer" style="position: fixed; bottom: 0px; right: 0px; z-index: 1000; width: 100%;">
                    <!-- Friends dock / chat bar -->
                        <div id="friend_dock_chattemplate" style="display: none;">
                            <div id="CHATUSERID_friend_dock_chatbox" userid="CHATUSERID" class="friend_dock_chatbox">
                                <div class="friend_dock_chatbox_titlebar blinkoffheader" userid="CHATUSERID">
                                    <div class="friend_dock_chatbox_username">
                                        <a style="color: #fff" class="friend_dock_chatbox_username_display" href="http://www.roblox.com/user.aspx?id=CHATUSERID">CHATUSERNAME</a>
                                        <a class="friend_dock_chatbox_username_abuse" style="color: #fff; font-size: 9px; line-height: 14px; cursor: pointer" alt="Report Abuse" href="#" onclick=" ReportAbuse(CHATUSERID); return false; ">(Report)</a>
                                    </div>
                                    <div class="friend_dock_chatbox_closebutton">
                                        <a href="#" style="color: #fff" onclick=" ChatBar.CloseChat($(this).parents(&#39;.friend_dock_chatbox&#39;).filter(&#39;:first&#39;));return false; ">-</a>
                                    </div>
                                </div>
                                <div class="friend_dock_chatbox_currentlocation" style="margin: 10px; font-size: 12px; height: 18px">
                                </div>
                                <div id="CHATUSERID_friend_dock_chatbox_chat" class="friend_dock_chatbox_chat">
                                </div>
                                <textarea class="friend_dock_chatbox_entry" maxlength="255" style=""></textarea>
                            </div>
                        </div>
                    <div id="friend_dock_friendtemplate" style="display: none;">
                        <div id="UID_CURRTAB_friend" userid="UID" username="USERNAME" class="friend_dock_friend">
                            <div id="UID_CURRTAB_onlinestatus" class="friend_dock_onlinestatus"></div>
                            <div id="UID_CURRTAB_offlinestatus" class="friend_dock_offlinestatus"></div>
                            <div id="UID_CURRTAB_dropdown" class="friendBarDropDown" userid="UID" username="USERNAME" style="display: none">
                                <div id="UID_CURRTAB_dropdownbutton" class="friend_dropdownbutton20"></div>
                                <div id="UID_CURRTAB_dropdownlist" class="friendBarDropDownList">
                                    <ul>
                                            <li onclick=" Party.InviteUser(&#39;USERNAME&#39;); " startpartydisplay=""><div>Invite To Party</div></li>
                                            <li class="StartChat" onclick=" ChatBar.ToggleChat(&#39;UID&#39;, &#39;USERNAME&#39;); " startchattingdisplay="" userid="UID"><div>Start Chatting</div></li>
                                        <li onclick=" window.location.href = &#39;/user.aspx?id=UID&#39;; "><div>View Profile</div></li>
                                            <li class="EndChat" style="display: none" onclick=" ChatBar.RemoveActiveChat(this); " userid="UID"><div>End Chat</div></li>
                                    </ul>
                                </div>    
                            </div>
                            <img thumbnail_holder="" alt="" onclick=" ChatBar.ToggleChat(&#39;UID&#39;, &#39;USERNAME&#39;); return false; " width="48" height="48" class="ActiveChatThumb">
                            <div class="friend_dock_username"><span class="friend_dock_username_href">USERNAMETRUNCATED</span></div>
                        </div>
                    </div>
                    <div style="position:relative">
                            <div id="friend_dock_chatholder">
                            </div>
                            <div id="partycontainer" style="display:none;margin-left:10px;float:right;">
                                
                    <div id="partyMemberTemplate" style="display:none;height:32px">
                        <div id="party_pendinguserid_UID">
                            <dt style="position:relative">
                                <span id="UID_status" class="friend_dock_offlinestatus"></span>
                                [PARTY_MEMBER_THUMBNAIL]
                            </dt> 
                            <dd> 
                                <span>[PARTY_MEMBER_NAME]</span>&nbsp;&nbsp;&nbsp;[PARTY_MEMBER_REPORT][PARTY_KICK_MEMBER]
                                <br> 
                                <span class="grey9">&nbsp;</span> 
                            </dd> 
                        </div>
                    </div>
                    {$js_party_val}
                    <script type="text/javascript" language="javascript">
                        try
                        {
                            $(function()
                            {
                                Party.ProcessPolledData(eval(({"Error" : "User not found in party"})));
                                Party.OnPageLoad();
                            });
                        }
                        catch (ex)
                        {
                        
                        }
                    </script>
                    <div class="partyWindow" id="party_none" style="display: block;"> 
                        <div id="party_none_title" class="title" onclick="Party.ToggleTab(false)">
                            <span>Party</span> 
                            <div class="closeparty">-</div>
                        </div> 
                        <div class="main"> 
                            <div id="new_party"> 
                                <p>You are not in a party.  To create a party, just invite someone:</p>
                                <p><input type="text" id="new_party_invite_name" class="party_invite_box" onkeydown="return Party.ProcessKey(&#39;new_party_invite_name&#39;,event)" style="color: rgb(136, 136, 136);"><input type="button" class="translate" onclick="Party.DoInvite(&#39;new_party_invite_name&#39;)" value="Invite"></p>
                            </div> 
                            <div class="clear" id="new_party_clear"> 
                            </div> 
                        </div> 
                    </div>
                    <div class="partyWindow" id="party_loading" style="display: none;"> 
                        <div id="party_loading_title" class="title" onclick="Party.ToggleTab(false)">
                            <span>Party</span>  
                            <div class="closeparty">-</div> 
                        </div> 
                        <div class="main"> 
                            <div> 
                                <p>Invitation sent.</p>
                                <p>Creating party...</p>
                            </div> 
                        </div> 
                    </div>
                    <div class="partyWindow" id="party_pending" style="display: none;">
                            <div id="party_pending_title" class="title" onclick="Party.ToggleTab(false)"> 
                                <span>Party</span>
                                <div class="closeparty">-</div> 
                            </div>
                            <div class="main"> 
                                <div id="invite_header" style="font-weight: bold; padding: 10px; color:Green;">RobloTim wants to party with you!</div> 
                                <div class="members"> 
                                    <dl id="party_invite_list"> 
                                    </dl> 
                                </div>
                            
                                <div id="invite_status"> 
                                    <p><span class="grey9">Invitations by Leader only</span></p> 
                                    <p><span class="grey9">Waiting for Leader to play a game</span></p> 
                                </div> 
                            
                                <div class="btn_green21h"> 
                                    <a href="#" onclick="Party.AcceptInvite();return false;">Join Party</a> 
                                </div> 
                            
                                <div class="btn_red21h"> 
                                    <a href="#" onclick="Party.DeclineInvite();return false;">Ignore</a> 
                                </div> 
                            
                                <div class="clear" id="invite_clear"> 
                                </div> 
                            </div>
                    </div> 
                    <div class="partyWindow" id="party_my" style="display: none;"> 
                        <div id="party_my_title" class="title" onclick="Party.ToggleTab(false)"> 
                            <span>Party</span> 
                            <div class="closeparty">-</div> 
                        </div> 
                        <div class="main" style="max-height: 588px;"> 
                            <div class="members"> 
                                <dl id="party_member_list"> 
                                
                                </dl> 
                            </div>
                        
                            <p id="party_invite_instructions"><span class="grey9"><input type="text" id="party_my_invite_name" class="party_invite_box" onkeydown="return Party.ProcessKey(&#39;party_my_invite_name&#39;,event)" style="color: rgb(136, 136, 136);"><input type="button" class="translate" onclick="Party.DoInvite(&#39;party_my_invite_name&#39;)" value="Invite"></span></p> 
                        
                            <div id="chat_messages"> 
                    
                            </div> 
                        
                            <div id="chat_input">
                                <textarea name="comments" rows="2" cols="27" id="comments" tabindex="4" title="comments" style=""></textarea>
                            </div> 
                        
                                <div id="party-auto-follow-setting" style="padding: 5px; text-align: center">
                                    <input id="auto-follow-party-leader" type="checkbox">
                                    <label for="auto-follow-party-leader">Automatically follow party leader</label>
                                    <script type="text/javascript">
                                        $("#auto-follow-party-leader").prop('checked', $.cookie('AutoFollowPartyLeader') == 'true');
                                        $("#auto-follow-party-leader").on("click", function () {
                                            // every time I join a party in the future, this cookie will determine whether or not I automatically follow the party leader
                                            $.cookie('AutoFollowPartyLeader', this.checked, { path: '/', expires: 365 });
                                            $.get("/chat/party.ashx", { reqtype: "autoFollowPartyLeader" });
                                        });
                                    </script>
                                </div>
                                    
                                <div id="party_current_game">
                                    <table border="0" style="padding: 0px; margin: 0px; border: 0px;">
                                        <tbody><tr style="padding: 0px; margin: 0px; border: 0px;">
                                            <td style="padding: 0px; margin: 0px; border: 0px;">
                                                <div id="party_game_thumb">
                                                </div>
                                            </td>
                                            <td style="padding: 0px; margin: 0px; border: 0px;">
                                                <div id="party_game_name" style="float: right;">
                                                </div>
                                                <span id="party_game_follow_me" class="followme_green19h" onclick="Party.JoinGameWithParty(); return false;"></span>
                                                <span class="btn_red21h">
                                                    <a href="#" onclick="Party.DeclineInvite();return false;">Leave Party</a>
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody></table>
                                </div>
                                    
                            <div class="clear" id="leader_clear"> 
                            </div> 
                                    
                        </div>
                    </div>
                                    
                            </div>
                            <div class="clear"></div>
                        </div>
                    <div id="friend_dock_minimized_container" style="">
                            <div style="float:right">
                                <a id="minChatsTab" href="#" class="tab_white19h">
                                    <span onclick="ChatBar.ShowFriends();return false;">
                                        <img src="/images/online.png" style="border: none">
                                        Online
                                    </span>
                                </a>
                            </div>
                        </div>
                        <div id="friend_dock_container" style="                                                  display: none
                ">
                           <div id="friend_dock_titlebar">
                               <div style="float:left;">
                                    
                                        <a id="bestFriendsTab" style="text-decoration: none" class="tab_white19h" href="#" onclick="ChatBar.TogglePanel(&#39;bestFriendsTab_dock_thumbnails&#39;);return false;"><span>Best Friends</span></a>
                                        <a id="friendsTab" style="text-decoration: none" class="tab_white19hselected" href="#" onclick="ChatBar.TogglePanel(&#39;friendsTab_dock_thumbnails&#39;);return false;"><span>Online Friends</span></a>
                                    <a id="recentsTab" style="text-decoration: none" class="tab_white19h" href="#" onclick="ChatBar.TogglePanel(&#39;recentsTab_dock_thumbnails&#39;);return false;"><span>Recent</span></a>
                                        <a id="chatsTab" style="text-decoration: none" class="tab_white19h" href="#" onclick="ChatBar.TogglePanel(&#39;chatsTab_dock_thumbnails_chat&#39;);return false;"><span>Chats</span></a>
                                </div>
                                <div style="float:right;">
                                        <div class="tab_white19h" id="partyTab" onclick=" Party.ToggleTab(null); return false; ">
                                            <span>
                                                <b><a href="#">Party</a></b>&nbsp;&nbsp;&nbsp;&nbsp;
                                            </span>
                                        </div>
                                    <div class="friend_dock_chatsettings" style="display:none">
                                        <div style="padding:10px 10px 10px 10px">
                                            <div class="chat_settings_group_header">Who can chat with me:</div>
                                            <input type="radio" id="chat_settings_all" name="rdoOnline"> <b>All Users</b><br>
                                            <input type="radio" id="chat_settings_friends" name="rdoOnline" checked="checked"> <b>Friends</b><br>
                                            <input type="radio" id="chat_settings_bestfriends" name="rdoOnline"> <b>Best Friends</b><br>
                                            <input type="radio" id="chat_settings_noone" name="rdoOnline"> <b>No One</b><br>
                                                    <hr>
                                                <div class="chat_settings_group_header">Who can party with me:</div>
                                                <input type="radio" id="party_settings_all" name="rdoOnline2"> <b>All Users</b><br>
                                                <input type="radio" id="party_settings_friends" name="rdoOnline2" checked="checked"> <b>Friends</b><br>
                                                <input type="radio" id="party_settings_bestfriends" name="rdoOnline2"> <b>Best Friends</b><br>
                                                <input type="radio" id="party_settings_noone" name="rdoOnline2"> <b>No One</b><br>
                                                <hr>
                                                <div class="chat_settings_group_header">Chat Notifications:</div>
                                                <input type="radio" id="chat_settings_soundon" name="rdoNotifications"> <b>All</b><br>
                                                <input type="radio" id="chat_settings_soundoff" name="rdoNotifications"> <b>None</b><br>
                                            <div style="text-align:center; margin-top: 5px;">
                                                <input type="button" onclick="ChatBar.ApplySettings();$(&#39;.friend_dock_chatsettings&#39;).hide();" value="Save">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab_white19h">
                                        <span>
                                            <b><a onclick="$(&#39;.friend_dock_chatsettings&#39;).toggle(); return false" href="#">Settings</a></b>&nbsp;&nbsp;&nbsp;
                                            <img src="/images/online.png" onclick="ChatBar.HideFriends();return false;" style="border: none; cursor: pointer" alt="Close chat">
                                        </span>
                                    </div>
                               </div>
                           </div>
                           <div id="friend_dock_thumb_container">
                                <!-- Container for the dynamically generated thumbs for friends -->
                                <div id="friendsTab_dock_thumbnails" style="">
                                    <div id="friendsTab_dock_thumbnails_empty" style="display:none; font-size:12px; margin-top:40px;">No results found.  Find some friends <a href="http://www.roblox.com/Browse.aspx">here</a>.</div>
                                </div>
                                    
                                <!-- Container for the dynamically generated thumbs for best friends -->
                                <div id="bestFriendsTab_dock_thumbnails" style="float:left; display: none">
                                    <div id="bestFriendsTab_dock_thumbnails_empty" style="display:none; font-size:12px; margin-top:40px;">No results? Start off by <a href="http://www.roblox.com/my/editfriends.aspx">adding some Best Friends.</a></div>
                                </div>
                                    
                                <!-- Container for the dynamically generated thumbs for recents -->
                                <div id="recentsTab_dock_thumbnails" style="float:left; display: none">
                                    <div id="recentsTab_dock_thumbnails_empty" style="display:none; font-size:12px; margin-top:40px;">You have not had any recent interactions.</div>
                                </div>
                                    
                                <!-- Container for the dynamically generated thumbs for chats -->
                                <div id="chatsTab_dock_thumbnails_chat" style="float:left; display: none">
                                    <div id="chatsTab_dock_thumbnails_chat_empty" style="display:none; font-size:12px; margin-top:40px;">You are not currently chatting with anyone.</div>
                                </div>
                           </div>
                        </div>
                        <div id="jPlayerDiv" style="position: absolute; top: 0px; left: -9999px;"><audio id="jqjp_audio_0" preload="none"></audio><div id="jqjp_force_0" style="text-indent: -9999px;">0.7583572196308523</div></div>
                    {$js_chat_info_val}
                </div>
                    
                        <script src="./ROBLOX.com_files/urchin.js" type="text/javascript"></script>
                        <script type="text/javascript">
                            _uacct = "UA-486632-1";
                            _udn = "roblox.com";
                            _uccn = "rbx_campaign";
                            _ucmd = "rbx_medium";
                            _ucsr = "rbx_source";
                            urchinTracker();
                            __utmSetVar('Visitor/Member');
                        </script>
                
                <div id="PlaceLauncherStatusPanel" style="display:none;width:300px">
                    <div class="modalPopup blueAndWhite PlaceLauncherModal" style="min-height: 160px">
                        <div id="Spinner" class="Spinner" style="margin:0 1em 1em 0; padding:20px 0;">
                            <img src="./ROBLOX.com_files/e998fb4c03e8c2e30792f2f3436e9416.gif" alt="Progress">
                        </div>
                        <div id="status" style="min-height:40px;text-align:center;margin:5px 20px">
                            <div id="Starting" class="PlaceLauncherStatus MadStatusStarting" style="display:block">
                                Starting Roblox...
                            </div>
                            <div id="Waiting" class="PlaceLauncherStatus MadStatusField">Connecting to Players...</div>
                            <div id="StatusBackBuffer" class="PlaceLauncherStatus PlaceLauncherStatusBackBuffer MadStatusBackBuffer"></div>
                        </div>
                        <div style="text-align:center;margin-top:1em">
                            <input type="button" class="Button CancelPlaceLauncherButton translate" value="Cancel">
                        </div>
                    </div>
                </div>
                    
                    
                <script type="text/javascript" src="https://js.rbxcdn.com/a007748692ad04a5c959493de9211f63.js.gzip"></script>
                    
                    <div id="videoPrerollPanel" style="display:none">
                        <div id="videoPrerollTitleDiv">
                            Gameplay sponsored by:
                        </div>
                        <div id="videoPrerollMainDiv"></div>
                        <div id="videoPrerollCompanionAd"></div>
                        <div id="videoPrerollLoadingDiv">
                            Loading <span id="videoPrerollLoadingPercent">0%</span> - <span id="videoPrerollMadStatus" class="MadStatusField">Starting game...</span><span id="videoPrerollMadStatusBackBuffer" class="MadStatusBackBuffer"></span>
                            <div id="videoPrerollLoadingBar">
                                <div id="videoPrerollLoadingBarCompleted">
                                </div>
                            </div>
                        </div>
                        <div id="videoPrerollJoinBC">
                            <span>Get more with Builders Club!</span>
                            <a href="http://www.roblox.com/Upgrades/BuildersClubMemberships.aspx?ref=vpr" target="_blank" id="videoPrerollJoinBCButton"></a>
                        </div>
                    </div>
                    <script type="text/javascript">
                        Roblox.VideoPreRoll.showVideoPreRoll = false;
                        Roblox.VideoPreRoll.loadingBarMaxTime = 30000;
                        Roblox.VideoPreRoll.videoOptions.key = "robloxcorporation";
                        Roblox.VideoPreRoll.videoOptions.categories = "NonBC,IsLoggedIn,Age13to14,Male";
                             Roblox.VideoPreRoll.videoOptions.id = "games";
                        Roblox.VideoPreRoll.videoLoadingTimeout = 11000;
                        Roblox.VideoPreRoll.videoPlayingTimeout = 23000;
                        Roblox.VideoPreRoll.videoLogNote = "";
                        Roblox.VideoPreRoll.logsEnabled = true;
                        Roblox.VideoPreRoll.excludedPlaceIds = "32373412";
                            
                                Roblox.VideoPreRoll.specificAdOnPlacePageEnabled = true;
                                Roblox.VideoPreRoll.specificAdOnPlacePageId = 157382;
                                Roblox.VideoPreRoll.specificAdOnPlacePageCategory = "stooges";
                            
                            
                                Roblox.VideoPreRoll.specificAdOnPlacePage2Enabled = true;
                                Roblox.VideoPreRoll.specificAdOnPlacePage2Id = 88419564;
                                Roblox.VideoPreRoll.specificAdOnPlacePage2Category = "lego";
                            
                        $(Roblox.VideoPreRoll.checkEligibility);
                    </script>
                
                <div id="GuestModePrompt_BoyGirl" class="Revised GuestModePromptModal" style="display:none;">
                    <div class="simplemodal-close">
                        <a class="ImageButton closeBtnCircle_20h" style="cursor: pointer; margin-left:455px;top:7px; position:absolute;"></a>
                    </div>
                    <div class="Title">
                        Choose Your Character
                    </div>
                    <div style="min-height: 275px; background-color: white;">
                        <div style="clear:both; height:25px;"></div>
                    
                        <div style="text-align: center;">
                            <div class="VisitButtonsGuestCharacter VisitButtonBoyGuest" style="float:left; margin-left:45px;"></div>
                            <div class="VisitButtonsGuestCharacter VisitButtonGirlGuest" style="float:right; margin-right:45px;"></div>
                        </div>
                        <div style="clear:both; height:25px;"></div>
                        <div class="RevisedFooter">
                            <div style="width:200px;margin:10px auto 0 auto;">
                                <a href="#" onclick="redirectPlaceLauncherToRegister(); return false;"><div class="RevisedCharacterSelectSignup"></div></a>
                                <a class="HaveAccount" href="#" onclick="redirectPlaceLauncherToLogin();return false;">I have an account</a>
                            </div>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    function checkRobloxInstall() {
                             return RobloxLaunch.CheckRobloxInstall('/install/download.aspx');
                    }
                        if (typeof MadStatus === "undefined") {
                            MadStatus = {};
                        }
                    
                        MadStatus.Resources = {
                            //<sl:translate>
                            accelerating: "Accelerating",
                            aggregating: "Aggregating",
                            allocating: "Allocating",
                            acquiring: "Acquiring",
                            automating: "Automating",
                            backtracing: "Backtracing",
                            bloxxing: "Bloxxing",
                            bootstrapping: "Bootstrapping",
                            calibrating: "Calibrating",
                            correlating: "Correlating",
                            denoobing: "De-noobing",
                            deionizing: "De-ionizing",
                            deriving: "Deriving",
                            energizing: "Energizing",
                            filtering: "Filtering",
                            generating: "Generating",
                            indexing: "Indexing",
                            loading: "Loading",
                            noobing: "Noobing",
                            optimizing: "Optimizing",
                            oxidizing: "Oxidizing",
                            queueing: "Queueing",
                            parsing: "Parsing",
                            processing: "Processing",
                            rasterizing: "Rasterizing",
                            reading: "Reading",
                            registering: "Registering",
                            rerouting: "Re-routing",
                            resolving: "Resolving",
                            sampling: "Sampling",
                            updating: "Updating",
                            writing: "Writing",
                            blox: "Blox",
                            countzero: "Count Zero",
                            cylon: "Cylon",
                            data: "Data",
                            ectoplasm: "Ectoplasm",
                            encryption: "Encryption",
                            event: "Event",
                            farnsworth: "Farnsworth",
                            bebop: "Bebop",
                            fluxcapacitor: "Flux Capacitor",
                            fusion: "Fusion",
                            game: "Game",
                            gibson: "Gibson",
                            host: "Host",
                            mainframe: "Mainframe",
                            metaverse: "Metaverse",
                            nerfherder: "Nerf Herder",
                            neutron: "Neutron",
                            noob: "Noob",
                            photon: "Photon",
                            profile: "Profile",
                            script: "Script",
                            skynet: "Skynet",
                            tardis: "TARDIS",
                            virtual: "Virtual",
                            analogs: "Analogs",
                            blocks: "Blocks",
                            cannon: "Cannon",
                            channels: "Channels",
                            core: "Core",
                            database: "Database",
                            dimensions: "Dimensions",
                            directives: "Directives",
                            engine: "Engine",
                            files: "Files",
                            gear: "Gear",
                            index: "Index",
                            layer: "Layer",
                            matrix: "Matrix",
                            paradox: "Paradox",
                            parameters: "Parameters",
                            parsecs: "Parsecs",
                            pipeline: "Pipeline",
                            players: "Players",
                            ports: "Ports",
                            protocols: "Protocols",
                            reactors: "Reactors",
                            sphere: "Sphere",
                            spooler: "Spooler",
                            stream: "Stream",
                            switches: "Switches",
                            table: "Table",
                            targets: "Targets",
                            throttle: "Throttle",
                            tokens: "Tokens",
                            torpedoes: "Torpedoes",
                            tubes: "Tubes"
                            //</sl:translate>
                        };
                </script>
                    
                <script type="text/javascript" src="https://js.rbxcdn.com/97bbdd6b901e1c791015f9c39e786455.js.gzip"></script>
                
                <div id="InstallationInstructions" class="modalPopup blueAndWhite" style="display:none;overflow:hidden">
                    <a id="CancelButton2" onclick="return Roblox.Client._onCancel();" class="ImageButton closeBtnCircle_35h ABCloseCircle"></a>
                    <div style="padding-bottom:10px;text-align:center">
                                            <img class="InstallInstructionsImage" modalwidth="597" delaysrc="http://images.rbxcdn.com/ed0d14e6d52d6aebb75371710c7e21c9.jpg" alt="Installation Instructions">
                        <br><br>
                    </div>
                </div>
                    
                    
                <div id="pluginObjDiv" style="height:1px;width:1px;visibility:hidden;position: absolute;top: 0;"><object id="robloxpluginobj" type="application/x-vnd-roblox-launcher"><p>You need Our Plugin for this.  Get the latest version from <a href="http://www.roblox.com/setup.roblox.com">here</a>.</p></object></div>
                <iframe id="downloadInstallerIFrame" style="visibility:hidden;height:0;width:1px;position:absolute"></iframe>
                
                
                <script type="text/javascript" src="https://js.rbxcdn.com/f01d0704a52a96a5c198c5097b6c70bc.js.gzip"></script>
                
                <script type="text/javascript">
                    Roblox.Client._skip = null;
                    Roblox.Client._CLSID = '76D50904-6780-4c8b-8986-1A7EE0B1716D';
                    Roblox.Client._installHost = 'setup.roblox.com';
                    Roblox.Client.ImplementsProxy = true;
                    Roblox.Client._silentModeEnabled = true;
                    Roblox.Client._bringAppToFrontEnabled = false;
                
                         Roblox.Client._installSuccess = function() { urchinTracker('InstallSuccess'); };
                        
                            if (window.chrome && window.location.hash == '#chromeInstall') {
                                window.location.hash = '';
                                var continuation = '(' + $.cookie('chromeInstall') + ')';
                                $.cookie('chromeInstall', null);
                                RobloxLaunch._GoogleAnalyticsCallback = function() { var isInsideRobloxIDE = 'website'; if (Roblox && Roblox.Client && Roblox.Client.isIDE && Roblox.Client.isIDE()) { isInsideRobloxIDE = 'Studio'; };GoogleAnalyticsEvents.FireEvent(['Play Location', 'User', isInsideRobloxIDE]);GoogleAnalyticsEvents.FireEvent(['Play', 'User', 'Over13', 1]);$(function(){ RobloxEventManager.triggerEvent('rbx_evt_play_user', {age:'Over13',gender:'Male'});}); }; 
                                Roblox.Client.ResumeTimer(eval(continuation));
                            }
                        
                        
                    $(function () {
                        Roblox.Client.Resources = {
                            //<sl:translate>
                            here: "here",
                            youNeedTheLatest: "You need Our Plugin for this.  Get the latest version from ",
                            plugInInstallationFailed: "Plugin installation failed!",
                            errorUpdating: "Error updating: "
                            //</sl:translate>
                        };
                    });
                
                </script>
                <span class="recent-place-name" style="display: inline; visibility: hidden; padding: 0px;">Base wars:The Land(since 2009) …</span><link rel="stylesheet" type="text/css" media="screen" href="chrome-extension://fcdjadjbdihbaodagojiomdljhjhjfho/css/atd.css"><iframe id="google_osd_static_frame_1860978028271" name="google_osd_static_frame" style="display: none; width: 0px; height: 0px;"></iframe></body></html> 
            HTML;
            return $html;
        }
    }
    static function renderNextStyleGuide(){
        global $site_properties;
        $host = htmlspecialchars($site_properties["hostname"]);
        $html = <<<HTML
        <footer class="container-footer">
        <div class="footer">
        <ul class="row footer-links">
            <li class="col-xs-4 col-sm-2 footer-link"><a href="//corp.{$host}" class="roblox-interstitial" target="_blank"><h2>About Us</h2></a></li>
            <li class="col-xs-4 col-sm-2 footer-link"><a href="//corp.{$host}/jobs" class="roblox-interstitial" target="_blank"><h2>Jobs</h2></a></li>
            <li class="col-xs-4 col-sm-2 footer-link"><a href="//blog.{$host}" class="roblox-interstitial" target="_blank"><h2>Blog</h2></a></li>
            <li class="col-xs-4 col-sm-2 footer-link"><a href="/Info/Privacy.aspx" target="_blank"><h2>Privacy</h2></a></li>
            <li class="col-xs-4 col-sm-2 footer-link"><a href="//corp.{$host}/parents" class="roblox-interstitial" target="_blank"><h2>Parents</h2></a></li>
            <li class="col-xs-4 col-sm-2 footer-link"><a href="//en.help.{$host}/" class="roblox-interstitial" target="_blank"><h2>Help</h2></a></li>
        </ul>
        <p class="footer-note">
            RBLXLOCAL, "Online Building Toy", characters, logos, names, and all related indicia are trademarks of <a target="_blank" href="//corp.{$host}" class="rbx-link roblox-interstitial">ROBLOX Corporation</a>, ©2015. Patents pending. RBLXLOCAL is not sponsored, authorized or endorsed by any producer of plastic building bricks, including The LEGO Group, MEGA Brands, and K'Nex, and no resemblance to the products of these companies is intended, especially within the usage of ROBLOX Corporation material, we are NOT AFFILIATED. Use of this site signifies your acceptance of the <a href="/info/terms-of-service" target="_blank" class="rbx-link">Terms and Conditions</a>.
        </p>
        
        
        </div>
        </footer>
        HTML;
        return $html;
    }
}
class SiteAlert {
    public static function render(): string
    {
        $alert = Alert::getLast();
        if (!$alert) {
            return '';
        }
        $text = htmlspecialchars($alert->getText(), ENT_QUOTES, 'UTF-8');
        return <<<HTML
        <div id="ctl00_Announcement">
            <div id="ctl00_SystemAlertDiv" class="SystemAlert" style="background-color: orange;">
                <div id="ctl00_SystemAlertTextColor" class="SystemAlertText">
                    <div id="ctl00_LabelAnnouncement">{$text}</div>
                </div>
            </div>
        </div>
        HTML;
    }
}
