<!-- WISH LIST BANNER DETAILS -->
<section class="home_wish_list_banner">
    <img class="img-fluid" alt="wish_list_banner"
         src="<?php echo base_url("assets/images/sub_banner_wish_list.png"); ?>">
</section>


<div class="container">
    <div class="col-md-12 text-center mt-2 pt-3 mb-4">
        <button onclick="addNewWish()" type="button" class="btn btn-outline-danger w-50 p-4"><i class="fas fa-plus fa-2x"></i> <span
                    class="add_new_wish_btn">&nbsp;NEW WISH</span></button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>


    <!--    <h4>My Wish List</h4>-->
    <!--    <p>This is my wish item list</p>-->
    <!-- MY WISH LIST ITEMS HOME-->
    <section class="bright py-2 text-center mt-2 pt-3 mb-4" id="wishListItemsList">
        <div class="container mx-auto">
            <div class="row mt-3">

                <div class="card mr-4 mb-4 wishListItem">
                    <img class="card-img-top" src="https://res.cloudinary.com/demo/image/upload/q_60/sample.jpg"
                         alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the card's content.</p>
                        <a href="#" class="btn btn-dark" data-toggle="modal" data-target="#exampleModalCenter"><i
                                    class="fas fa-share-alt"></i> SHARE</a>
                        <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter"><i
                                    class="far fa-trash-alt"></i> DELETE</a>
                        <a href="#" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter"><i
                                    class="fas fa-edit"></i> EDIT</a>
                    </div>
                </div>


                <div class="card mr-4 mb-4 wishListItem">
                    <img class="card-img-top" src="https://res.cloudinary.com/demo/image/upload/q_60/sample.jpg"
                         alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the card's content.</p>
                        <a href="#" class="btn btn-dark" data-toggle="modal" data-target="#exampleModalCenter"><i
                                    class="fas fa-share-alt"></i> SHARE</a>
                        <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter"><i
                                    class="far fa-trash-alt"></i> DELETE</a>
                        <a href="#" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter"><i
                                    class="fas fa-edit"></i> EDIT</a>
                    </div>
                </div>

                <div class="card mr-4 mb-4 wishListItem">
                    <img class="card-img-top" src="https://res.cloudinary.com/demo/image/upload/q_60/sample.jpg"
                         alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the card's content.</p>
                        <a href="#" class="btn btn-dark" data-toggle="modal" data-target="#exampleModalCenter"><i
                                    class="fas fa-share-alt"></i> SHARE</a>
                        <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter"><i
                                    class="far fa-trash-alt"></i> DELETE</a>
                        <a href="#" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter"><i
                                    class="fas fa-edit"></i> EDIT</a>
                    </div>
                </div>
            </div>
        </div>

    </section>

</div>

<script type="text/javascript">

    addNewWish = function () {
        location.href = "<?php echo base_url() ?>index.php/AddNewWish";
    }

</script>