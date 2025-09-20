<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .gallery {
            padding: 60px 0;
        }

        .gallery img {
            width: 100%;
            padding: 10px;
            background: #fff;
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.25);
            cursor: pointer;
            border-radius: 5px;
        }

        .modal-img {
            width: 100%;
        }
    </style>
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg bg-primary-subtle">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    </ul>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadModal">
                        Add
                    </button>

                    <!-- Start Modal -->
                    <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Upload Image</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="insert.php" method="post" enctype="multipart/form-data" class="d-flex">
                                        <!-- File Input -->
                                        <input type="file" class="form-control me-2" name="image" required>
                                        <!-- Submit Button -->
                                        <button class="btn btn-outline-info" type="submit">Add</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal -->

                </div>
            </div>
        </nav>
    </header>

    <section class="gallery min-vh-100">
        <div class="container-lg">

            <div class="row g-4 row-cols-1 row-cols-sm-2 row-cols-md-3">
                <?php
                $conn = mysqli_connect("localhost", "root", "", "image_view");
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }
                // Fetch images
                $sql = "SELECT * FROM gallery ORDER BY id DESC";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) 
                {
                    while ($row = mysqli_fetch_assoc($result)) 
                    {
                ?>

                    <div class="col">
                        <img src="upload/<?php echo $row['image']; ?>" alt="" class="img-fluid preview-img">
                    </div>

                <?php
                    }
                } 
                else 
                {
                    echo "No records found.";
                }
                 mysqli_close($conn);
                ?>

            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="" class="modal-img" alt="Preview">
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>


    <script>
        $(document).ready(function() {
            $(".preview-img").click(function() {
                let src = $(this).attr("src");
                $(".modal-img").attr("src", src);
                $("#exampleModal").modal("show");
            });
        });
    </script>

</body>

</html>