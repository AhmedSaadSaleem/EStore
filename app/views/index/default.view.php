    <div class="home-view">
        <div class="container">
            <section class="articles">
                <?php
                if($articles !== false){
                    foreach($articles as $article){ ?>
                        <article class="article-box d-flex bg-white p-20 mb-10 rad-10 p-relative">
                            <span class="date c-grey fs-13 p-absolute"><?= $article->date ?></span>
                            <h3 class="c-grey w-full"><?= $article->articleTitle ?></h3>
                            <p class="pt-20 w-full"><?= $article->articleText ?></p>
                            <span class="author c-grey p-absolute"><?= $article->getAuthor() ?></span>
                            <a class="more-btn btn-shape bg-blue c-white d-block w-fit mt-10" href="">More</a>
                        </article>
                <?php } } ?>
            </section>
        </div>
    </div>