<nav class="navbar navbar-expand-lg navbar-light bg-light rounded">
    <a class="navbar-brand" href="/">Vonberg Valve Test</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExample09">
        <ul class="navbar-nav mr-auto">
            <?php
            foreach($categories as $category) {
                ?>
                <li><?= $this -> Html -> link($category["name"], array("action" => "catalog", $category["categoryID"])) ?></li>
                <?php
            }
            ?>
            <li class="nav-item">
                <a class="nav-link disabled" href="/dealers/">Dealer Management</a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="/" id="dropdown09" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                <div class="dropdown-menu" aria-labelledby="dropdown09">
                    <a class="dropdown-item" href="#">About Vonberg</a>
                    <a class="dropdown-item" href="/locator">Dealer Locator</a>
                    <?php if (!$Auth->user()) { ?>
                        <a class="login" href="<?php echo $this->Url->build($Auth->getConfig('loginAction')); ?>">Login</a>
                    <?php } else { ?>
                        <a class="dropdown-item" href="/admin/">CMS</a>
                        <a class="dropdown-item" href="/logout">Logout</a>

                    <?php } ?>

                </div>
            </li>
        </ul>
        <form class="form-inline my-2 my-md-0">
            <input class="form-control" type="text" placeholder="Search" aria-label="Search">
        </form>
    </div>
</nav>
