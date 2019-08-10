
<div class="white-box new-box-select">
                            <div class="white-box-heading">Step:1 Select Your Account</div>
                            <div class="great-start-my">We've identified multiple accounts associated with Google. Please select one account to assess.<br> Remember, you can always come back anytime.</div>
                            <div class="table-box-select">
                                <div class="table-box-select-new">
                                    <form action="<?php echo $redirect; ?>" method="post">
                                        <input type="hidden" name="lacationid" value="<?php echo $accountid; ?>" />
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <td><strong>BUSINESSES</strong></td>
                                                    <td><strong>STATUS</strong></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($locations['locations'] as $k => $v) {
                                                    $locationState = $v['locationState'];
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <label>
                                                                <input name="accounts[]" value='<?php echo base64_encode(json_encode($v)); ?>' type="checkbox"/>
                                                                <span></span>
                                                                <?php echo $v['locationName']; ?>
                                                            </label>
                                                            <div style="padding-left: 35px;"><small class="text-muted"><?php echo $v['address']['addressLines'][0]; ?></small></div></td>
                                                        <td>
                                                            <?php
                                                            if ($locationState['isDuplicate']) {
                                                                echo 'Duplicate';
                                                            } else if ($locationState['isPublished']) {
                                                                echo 'Published';
                                                            }
                                                            ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <div class="btn-green"><input type="submit" name="" value="NEXT"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
