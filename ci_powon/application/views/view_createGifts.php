<div class="container">
    <div class="row">
        <div class=""></div>
    </div>

    <ul class="nav nav-pills">
        <li role="presentation" ><?php echo anchor('controller_email/viewReceivedEmail', "Inbox "
                .'<span class="badge"> ' . $numberReceived[0]->numberOfmessage .'</span>'); ?>
        </li>
        <li role="presentation"><?php echo anchor('controller_email/viewSentEmail', "Sent Box "
                .'<span class="badge"> ' .$numberSent[0]->numberOfmessage .'</span>'); ?>
        </li>
        <li  role="presentation" class=""><?php echo anchor('controller_email/createEmail',
                'Create </spam><span style="font-size: 1.3em" class="glyphicon glyphicon-envelope " aria-hidden="true">'); ?>
        </li>
        <li  style="margin-left :100px;" role="presentation" ><?php echo anchor('controller_email/InviteToPowon',
                '<spam >Invite </spam><span style="font-size: 1.3em" class="glyphicon glyphicon-send" aria-hidden="true"></span>'); ?>
        </li>
        <li style="margin-left :100px;" role="presentation" class=""><?php echo anchor('controller_gift/viewReceivedGift', '<span class="glyphicon glyphicon-gift " aria-hidden="true"></span> Received'
                .'<span class="badge"> ' . $GiftnumberReceived[0]->numberOfmessage .'</span>'); ?>
        </li>
        <li role="presentation" class=""><?php echo anchor('controller_gift/viewSentGift', '<span class="glyphicon glyphicon-gift " aria-hidden="true"></span> Send'
                .'<span class="badge"> ' . $GiftnumberSent[0]->numberOfmessage .'</span>'); ?>
        </li>
        <li  role="presentation" class="active"><?php echo anchor('controller_gift/createGifts',
                'Create <span style="font-size: 1.3em" class="glyphicon glyphicon-gift " aria-hidden="true"></span>'); ?>
        </li>
        <li style="margin-left :150px; font-size: 1.75em" role="presentation"><?php echo anchor('controller_gift/createGifts', '<span class="glyphicon glyphicon-refresh text-success" aria-hidden="true"></span>'); ?>
        </li>

    </ul>
</div>
<!-- show link to each inbox + number of emails-->





<?php echo validation_errors(); ?>


<div class="container" style="width: 800px">
    <?php
    $attributes = array('role' => 'form', 'class'=> 'form-horizontal');
    ?>

    <?php echo form_open('controller_gift/sendCreatedGift', $attributes); ?>
    <fieldset>
        <legend>New Email</legend>
        <div class="form-group">
            <label class="col-sm-3 control-label">Sent</label>
            <div class="col-sm-9">
                <select name="member" class="form-control">
                    <option value="NotSelected" class="text-center">--- Select ---</option>
                    <?php
                    foreach($result as $row) {
                        echo "<option class='text-center' value='$row->powon_id'>$row->username</option>";
                    }
                    ?>
                </select>
                <br/>
                <?php if( $UserSelected == false )
                {
                    echo '<div class="form-control alert-danger text-center">' .'Please Choose a User' .'</div>';
                } ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Content</label>
            <div class="col-sm-9">
                <textarea name = "content" rows = "5" cols = "50" class="form-control"></textarea>
                <br/>

            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Image</label>
            <div class="col-sm-9">
                <br/>

                <div class="row">
                    <div class="col-sm-4 ">
                        <div class="row">
                            <label>
                                <input  type="radio" name="gift_content" value="Birthday.jpg" />
                                <img src="/~lfc353_2/ci_powon/images/Birthday.jpg" height="100" width="100"/>
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="row">
                            <label>
                                <input type="radio" name="gift_content"  value="Easter.jpg"/>
                                <img src="/~lfc353_2/ci_powon/images/Easter.jpg" height="100" width="100"/>
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="row">
                            <label>
                                <input type="radio" name="gift_content"  value="Valentines.jpg"/>
                                <img src="/~lfc353_2/ci_powon/images/Valentines.jpg" height="100" width="100"/>
                            </label>
                        </div>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-sm-4 ">
                        <div class="row">
                            <label>
                                <input type="radio" name="gift_content"  value="NewYears.jpg"/>
                                <img src="/~lfc353_2/ci_powon/images/NewYears.jpg" height="100" width="100"/>
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="row">
                            <label>
                                <input type="radio" name="gift_content" value="Thanksgiving.jpg" />
                                <img src="/~lfc353_2/ci_powon/images/Thanksgiving.jpg" height="100" width="100"/>
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="row">
                            <label>
                                <input type="radio" name="gift_content"  value="Christmas.jpg"/>
                                <img src="/~lfc353_2/ci_powon/images/Christmas.jpg" height="100" width="100"/>
                            </label>
                        </div>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <label>
                        <input type="radio" name="gift_content" value="Halloween.jpg"  />
                        <img src="/~lfc353_2/ci_powon/images/Halloween.jpg" height="100" width="100"/>
                    </label>
                </div>

            </div>
    </fieldset>
    <br/>
    <fieldset>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
                <input type = "submit" value = "send" class="btn btn-primary"/>
                <input type = "reset" value = "reset" class="btn btn-default"/>
            </div>
        </div>
    </fieldset>

    </form>
</div>






