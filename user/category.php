<?php include "includes/header.php"; ?>

<!-- Navigation -->
<?php include "includes/navigation.php"; ?>


	<!--==========================
    INSIDE HERO SECTION Section
	============================-->
	<section class="page-image page-image-blog md-padding">
		<h1 class="text-white text-center">BLOG</h1>
	</section>

	<!--==========================
    Contact Section
	============================-->
	<section id="blog" class="md-padding">
		<div class="container">
			<div class="row">
				<main id="main" class="col-md-8">

					<div class="row">
						<?php
							if(isset($_GET['category'])){
								$selected_category = $_GET['category'];
							}

							$sql_query = "SELECT * FROM posts WHERE post_category = '$selected_category'";
							$posts = mysqli_query($conn, $sql_query);
							
							while($post = mysqli_fetch_assoc($posts)){
								$post_id = $post["post_id"];
								$post_title = ucfirst($post["post_title"]);   // ucfirst(); Capitilizes the first letters of each word
								$post_author = $post["post_author"];
								$post_date = $post["post_date"];
								$post_img = $post["post_img"];
								$post_text = substr($post["post_text"], 0, 100);   // substr($text, i, n); Takes the n number of characters starting from position i
								$post_tags = $post["post_tags"];
								$post_hits = $post["post_hits"];

								$comments_query = "SELECT * FROM comments WHERE comment_post_id = {$post_id} AND comment_status = 'approved' ORDER BY comment_id DESC";
								$comments = mysqli_query($conn, $comments_query);
								$comments_count = mysqli_num_rows($comments);
						?>

						<!-- Blog-Post -->
						<div class="col-md-6">
							<div class="blog">
								<div class="blog-img">
									<img src=<?php echo "img/$post_img"; ?> class="img-fluid">
								</div>
								<div class="blog-content">
									<ul class="blog-meta">
										<li><i class="fas fa-users"></i><span class="writer"><?php echo $post_author; ?></span></li>
										<li><i class="fas fa-clock"></i><span class="writer"><?php echo $post_date; ?></span></li>
										<li><i class="fas fa-comments"></i><span class="writer"><?php echo $comments_count; ?></span></li>
										<li><i class="fas fa-eye"></i><span class="writer"><?php echo $post_hits; ?></span></li>
									</ul>
									<h3><?php echo $post_title; ?></h3>
									<p><?php echo $post_text; ?></p>
									<a href="blog-single.php?read=<?php echo $post_id; ?>">Read More</a>
								</div>
							</div>
						</div>

						<!-- Blog-Post END -->
						<?php	} ?>

					</div>

					<!-- TODO: automatize the pagination! -->
					<div class="row">
						<!-- Pagination -->
						<div class="col-md-6">
							<nav aria-label="Page navigation example">
								<ul class="pagination justify-content-center">
									<li class="page-item disabled">
										<a class="page-link" href="#" tabindex="-1">Previous</a>
									</li>
									<li class="page-item"><a class="page-link" href="#">1</a></li>
									<li class="page-item"><a class="page-link" href="#">2</a></li>
									<li class="page-item"><a class="page-link" href="#">3</a></li>
									<li class="page-item">
										<a class="page-link" href="#">Next</a>
									</li>
								</ul>
							</nav>
						</div>
					</div>
				</main>
				
				<!-- Sidebar -->
				<?php include "includes/sidebar.php"; ?>
				
			</div>
		</div>
	</section>

<!-- Footer -->
<?php include "includes/footer.php"; ?>