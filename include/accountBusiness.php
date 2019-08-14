
                        <div class="white-box new-box-select">
                            <?php
                            $locations = json_encode($locations['locations']);
                            $locations = str_replace("'", '*', $locations);
                            ?>
                            <div ng-init='friends = <?php echo $locations; ?>'></div>
                            <div class="white-box-heading">Step:1 Select Your Account</div>
                            <div class="great-start-my">We've identified multiple accounts associated with Google. Please select one account to assess.<br> Remember, you can always come back anytime.</div>
                            <div class="table-box-select">
                                <div class="table-box-select-new">
                                    <form action="<?php echo $redirect; ?>" method="post">
                                        <input type="hidden" name="lacationid" value="<?php echo $accountid; ?>" />
                                        <label class="searchtext">Search: <input ng-model="searchText" class="form-control searchinput" placeholder="Enter Business Name"></label>
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0" id="searchTextResults">
                                            <thead>
                                                <tr>
                                                    <td><strong>BUSINESSES</strong></td>
                                                    <td><strong>STATUS</strong></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="friend in friends | filter:searchText">
                                                        <td>
                                                            <label>
                                                                <input name="accounts[]" value='{{friend | json}}' type="checkbox"/>
                                                                <span></span>
                                                                {{friend.locationName}}
                                                            </label>
                                                            <div style="padding-left: 35px;"><small class="text-muted">{{friend.address.addressLines[0]}}<?php //echo $v['address']['addressLines'][0]; ?></small></div></td>
                                                        <td>
                                                            <div ng-if="friend.locationState.isDuplicate">Duplicate</div>
                                                            <div ng-if="friend.locationState.isPublished">Published</div></td>
                                                    </tr>
                                            </tbody>
                                        </table>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <?php if(!empty($_GET['PageToken'])) { ?>
                                                <a href="#" onclick="history.back();return false;" class="btn btn-primary">Previous Page</a>
                                                <?php } ?>
                                                <?php if(!empty($_SESSION['nextPageToken'])) { ?>
                                                    <a href="<?php echo BASE_URL; ?>?PageToken=<?php echo $_SESSION['nextPageToken']; ?>" class="btn btn-primary">Next Page</a>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="btn-green"><input type="submit" name="" value="NEXT"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
