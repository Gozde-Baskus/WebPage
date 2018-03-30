<?php


$results = DB::query("
SELECT 
    wpp.ID, 
    wpp.post_date, 
    wpp.post_content, 
    wpp.post_title, 
    wpp.post_name,
    wpp.post_excerpt,
    (SELECT wpi.guid FROM wp_posts as wpi WHERE wpi.post_parent = wpp.ID AND wpi.post_type = 'attachment' LIMIT 1) as post_image
FROM wp_posts as wpp 
WHERE wpp.post_status = 'publish' AND wpp.post_type = 'post'");


?>

<section id="blog" class="screen">
    <div class="container">
        <h2 class="text-center">BLOG</h2>
        <div class="row">


            <?php

            foreach ($results as $row) {

                ?>

                <div class="col-sm">

                    <div class="card mx-auto mb-4" style="width: 18rem;">
                        <img class="card-img-top" src="<?php echo $row['post_image']; ?>" alt="Card image cap">
                        <div class="card-body text-center p-0 py-2">
                            <h6 class="card-title"><?php echo $row['post_title']; ?> </h6>
                            <a href="#" class="btn btn-dark" data-toggle="modal" data-target="#modal-<?php echo $row['post_name']; ?>">İncele</a>
                        </div>
                    </div>
                </div>


                <?php

            }

            ?>

        </div>
    </div>


    <?php

    foreach ($results as $row) {

    ?>
    <div class="modal fade" id="modal-<?php echo $row['post_name']; ?>" aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title"><strong><?php echo $row['post_title']; ?> </strong>/ <?php echo $row['post_excerpt']; ?> </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-dark text-white">
                    <?php echo $row['post_content']; ?>
                </div>
                <div class="modal-footer bg-dark text-white">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <?php

    }

    ?>


</section>