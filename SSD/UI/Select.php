<section class="about-section text-center selectpage" id="pages">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h2 class="text-white mb-4">Select FaceBook Page</h2>
                        
                <div class="form-group">
                    <select  class="selectpicker form-control" data-live-search="true" id="pagename" onchange="getPost()">
                        <?php
                            foreach($_SESSION['Pages']['data'] as $key=>$page){
                                $pagen=$page['name'];
                                echo "<option data-tokens='$pagen' value='$key'>$pagen</option>";
                            }
                        ?>
                        
                    </select>
                </div>
            </div>
        </div>

    </div>
</section>
