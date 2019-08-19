<?php include "header_navigation.php";
$result = $conn->prepare("SELECT * FROM users ORDER BY last_name");
$result->execute();
$users = $result->fetchAll();
?>
<div class="container-fluid">
	 <div class="table-responsive">
			<table class="table table-bordered table-striped table-hover" style="overflow-x:auto;">
				 <thead class="thead-light">
						<tr>
							 <th align="center"colspan="15">
									<h3><b>Users</b></h3>
							 </th>
						</tr>
				 </thead>
<tbody>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
												<th>Date Created</th>
												<th>Date Modified</th>
												<th>Last Login Date</th>
												<th colspan="2"></th>
                    </tr>
                    <?php foreach ($users as $user) :
											?>
                        <tr>
                            <td>
                                <?php echo $user['first_name']; ?>
                            </td>
                            <td>
                                <?php echo $user['last_name']; ?>
                            </td>
                            <td>
                                <?php echo $user['email']; ?>
                            </td>
                            <td colspan="1">
                                <?php echo phoneNumberFormat($user['phone_number'])?>
                            </td>
													  <td>
															<?php echo dateCustomFormat($user['date_created']) ?>
														</td>
														<td>
															<?php echo dateModifiedCustomFormat($user['date_modified']) ?>
														</td>
														<td>
															  <?php echo dateCustomFormat($user['date_lastlogin']); ?>
														</td>
                            <td>
                                <?php include "user_edit_button.php"; ?>
                            </td>
														<?php if($_SESSION['user_level'] ==='administrator'){ ?>
															<td><?php include "user_delete_button.php";?>
															</td>
														<?php } ?>
                        </tr>
                        <?php endforeach; ?>
											</tbody>
										</table>
									</div>
									  <?php include "footer.php";?>
