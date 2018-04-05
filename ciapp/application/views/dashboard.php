<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$CI = get_instance();
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>My Phone Book</title>

    <link href="//stackpath.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
          crossorigin="anonymous"/>

    <link href="https://uxsolutions.github.io/bootstrap-datepicker/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"
          rel="stylesheet">

    <link href="/assets/css/style.css"
          rel="stylesheet"/>

</head>
<body>

<div class="header">
    <?=$CI->session->name?> &nbsp; | &nbsp;
    <?php if(isset($filter_cancel_link)) { ?>
        <a href="/">Clear Search</a> &nbsp; | &nbsp;
    <?php } ?>
    <a href="/login/terminate">Logout</a>
</div>

<div class="search-container">
    <form>
        <input name="q" value="<?=isset($filter['q'])?$filter['q']:''?>" class="form-control" style="width:350px;float:left;" placeholder="Search by name, phone number or note"/>
        <div class="filler"> created between </div>
        <input name="s" value="<?=isset($filter['s'])?$filter['s']:''?>" class="form-control datepicker" style="width:115px;float:left;" placeholder="any date"/>
        <div class="filler"> to </div>
        <input name="e" value="<?=isset($filter['e'])?$filter['e']:''?>" class="form-control datepicker" style="width:115px;float:left;" placeholder="any date"/>
        <button style="float:left;margin-left:20px;border:1px solid #ccc" class="btn btn-default">
            <i class="fas fa-search"></i> Search
        </button>
    </form>
    <button style="float:right;border:1px solid #ccc" class="addcontact btn btn-primary">
        <i class="fas fa-plus"></i> ADD
    </button>
    <div style="clear:both;"></div>
</div>


<div class="data-list">

    <?php if(!isset($result) || count($result) == 0) { ?>
    <div style="width:400px;text-align:center;font-size:22px;margin:auto;padding:40px;">
        <i class="fas fa-exclamation-triangle"></i> &nbsp; No Records Found
    </div>
    <?php } else { ?>
    <table class="citable table table-bordered">
        <thead>
            <tr>
                <th>Created</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Note</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($result as $contact) { ?>
            <tr cid="<?=$contact['id']?>">
                <td class="created"><?=$contact['created_at']?></td>
                <td class="name"><?=$contact['name']?></td>
                <td class="phone"><?=$contact['phone']?></td>
                <td class="note"><?=$contact['note']?></td>
                <td style="text-align:right;">
                    <a class="editcontact" href=""><i class="fas fa-edit"></i> Edit</a> &nbsp; | &nbsp;
                    <a class="delcontact" href="/dashboard/cdel/<?=$contact['id']?>"><i class="fas fa-trash-alt"></i> Delete</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

        <?php if (isset($links) && $links != null) { ?>
            <div class="pagination">
                <?php echo $links ?>
            </div>
        <?php } ?>

    <?php } ?>
</div>


<div id="entryForm" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Adding Contact</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

                <div class="modal-body">

                    <form id="contact-form" method="post" action="/dashboard/contact">
                        <div class="form-group row">
                            <label for="staticName" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" id="staticName" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticPhone" class="col-sm-2 col-form-label">Phone</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="phone" id="staticPhone" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticNote" class="col-sm-2 col-form-label">Note</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="note" id="staticNote" placeholder="(Optional)"></textarea>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success save-contact">Save</button>
                </div>


        </div>
    </div>
</div>



<script src="//code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="//stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous">
</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
<script defer src="//use.fontawesome.com/releases/v5.0.9/js/all.js"
        integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl"
        crossorigin="anonymous">
</script>
<script src="/assets/script/app.js"></script>

</body>
</html>