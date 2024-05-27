<?php require_once 'admin_header.php' ?>

<div class="row">
        <div class="col-lg-6 offset-lg-3">
            <section class="card">
                <header class="card-header">
                    <h3 style="display: inline-block;margin-right: 25px;">Add General Education Subject</h3>
                </header>
                <div class="card-body">
                    <form action="insert_gen.php" method="post" enctype="multipart/form-data">
                    <div class="form-group row">
                    <label for="inputImage" class="col-sm-3 col-form-label">Image</label>
                            <div class="col-sm-9">
                                <input type="file" id="inputImage" class="form-control" name="image" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" required class="form-control" id="inputName" placeholder="File Name" name="name">
                            </div>
                        </div>
                        <div class="form-group row">
                        <label for="inputPdf" class="col-sm-3 col-form-label">Pdf</label>
                            <div class="col-sm-9">
                                <input type="file" id="inputPdf" class="form-control" name="pdf" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12">
                                <input type="submit" class="btn btn-info btn-block" name="gen-btn" value="Save">
                            </div>
                        </div>
                    </form>
                </div>
            </section>

        </div>
    </div>

<?php require_once 'footer.php'?>