<style>

.section-title h5 {
    color: #5603fc;
    font-size: 15px;
    font-weight: 700;
    margin-bottom: 10px;
    letter-spacing: 0.3px;
}

.section-title h2 {
    font-weight: 700;
    text-transform: capitalize;
    font-size: 38px;
    line-height: 1.3;
    color: #333;
}

.section-title {
    text-align: center;
    margin-top: 20px;
    margin-bottom: 30px;
}

.single-team-box {
    margin-top: 30px;
    overflow: hidden;
    -webkit-transition: 0.5s;
    transition: 0.5s;
}

.single-team-box .team-image{
    display: flex;
    justify-content: center;
}

.single-team-box .team-image img {
    width: 400px;
    height: auto;
    -webkit-transition: 0.5s;
    transition: 0.5s;
}

img {
    max-width: 100%;
    vertical-align: middle;
    border-style: none;
}

.team-info {
    padding: 20px 15px 0px;
    text-align: center;
    -webkit-transition: 0.5s;
    transition: 0.5s;
}

.team-image {
    position: relative;
    z-index: 1;
    border-radius: 3px;
    overflow: hidden;
}

.team-info h3 {
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 0;
}

.team-info span {
    color: #5603fc;
    font-size: 14px;
    font-weight: 500;
    display: block;
}

.team-image::before {
    content: "";
    position: absolute;
    z-index: 2;
    top: 0;
    left: 0;
    padding: 0;
    height: 100%;
    width: 100%;
    opacity: 0;
    visibility: hidden;
    background: #000;
    -webkit-transition: 0.5s;
    transition: 0.5s;
}
    
</style>

<!--begin::Container-->
<div class="container-fluid fundo-padrao" style="margin-top: 44.86px;">
    <!--begin::Card-->
    <div class="card card-custom card-padrao">
        <!--begin::Header-->
        <!-- <div class="card-header">
            <div class="card-title">
                <h3 class="card-label font-weight-bolder text-dark">Início</h3>
            </div>
            <div class="card-toolbar">
            </div>
        </div> -->
        <!--end::Header-->
        <!--begin::Body-->                    
        <div class="card-body">
            <div class="container-xxl">
                
                <div class="row">

                    <div class="col-md-12">
                        <div class="section-title">                            
                            <h2>Sobre</h2>
                            <h5>Saiba mais sobre nós</h5>
                        </div>
                    </div>

                    <div class="container">
                        <div class="col-lg-12 mt-10 mb-5 text-center">
                            <h4 class="font-weight-bold">Missão</h4>
                            <h5>Lorem ipsum posuere rhoncus nisi tellus magna porttitor suspendisse, libero et consectetur ad aenean curae. aenean est cursus duis vel in curabitur amet tempus, aenean dapibus faucibus nec habitasse torquent porttitor suscipit.</h5>
                        </div>

                        <div class="col-lg-12 mb-5 text-center">
                            <h4 class="font-weight-bold">Visão</h4>
                            <h5>Habitant platea eget condimentum ultrices aenean nisl maecenas facilisis conubia in, cubilia litora conubia magna netus tortor sapien cras suspendisse suscipit donec.</h5>
                        </div>

                        <div class="col-lg-12 mb-5 text-center">
                            <h4 class="font-weight-bold">Valores</h4>
                            <h5>Eros lacus etiam tincidunt pellentesque dictum tempus nam, justo varius sit sociosqu primis massa lobortis tortor, consequat felis dictum vehicula magna risus.</h5>
                        </div>
                    </div>
                    
                </div>

            </div>
        </div>                    
        <!--end::Body-->
    </div>
    <!--end::Card-->        
</div>
<!--end::Container-->

