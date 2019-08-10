<?php
$accountsList = $accounts->listAccounts();
                $c = count($accountsList);
                if ($c > 1) {
                    ?>
                    <div class="white-box new-box-select">
                        <div class="white-box-heading">Step:1 Select Your Account</div>
                        <div class="great-start-my">We've identified multiple accounts associated with Google. Please select one account to assess.<br> Remember, you can always come back anytime.</div>
                        <div class="table-box-select">
                            <div class="table-box-select-new">
                                <form action="<?php echo $redirect; ?>" method="post">
                                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <td><strong>ACCOUNT</strong></td>
                                                <td><strong>TYPE</strong></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($accountsList as $k => $v) { ?>
                                                <tr>
                                                    <td><label><input name="accountid" value="<?php echo $v->name; ?>" type="radio"/><span></span> <?php echo $v->accountName; ?></label></td>
                                                    <td>Personal</td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    <div class="btn-green"><input type="submit" name="" value="SELECT ACCOUNT"></div>
                                </form>
                            </div>
                        </div>

                        <?php
                    } else {
                        $_SESSION['accountid'] = $accountsList[0]->name;
                        ?>
                        <script type="text/javascript">
                            window.location.href = '<?php echo $redirect; ?>';
                        </script>
                        <?php
                    }
