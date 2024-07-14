		<footer>

			<form id="subForm" action="../controller/subscription_add_process.php" method="get" enctype="multipart/form-data">
				<div>
					<input id="subEmail" type="text" name="subEmail" required />
					<select id="subCategory" name="subCategory" >
						<option value="%" selected>All</option>						
						<!-- get the rest of dropdown list from database -->
						<?php foreach($categoryLibrary as $categoryOption):?>
							<?php $categoryID = $categoryOption['subCatID']; $categoryText = $categoryOption['subCategory']; ?>
							<?php echo "<option value=\"$categoryID\">$categoryText</option>"; ?>
						<?php endforeach; ?>
					</select>
					<input id="subSubmit" type="submit" value="Subscribe" />
				</div>
			</form>

			<!-- Copyright -->
			<p>Rossco's Coffee &copy; <?php echo date('Y'); ?> | Developed by Ross WANG</p>			
		</footer>
	</section>
</body>
</html>