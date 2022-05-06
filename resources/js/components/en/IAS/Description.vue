<template>
    <div>
        <div class="container">
            <div class="ias_description row">
                <div class="span col-md-6 col-sm-12">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="icon">
                                <b-icon icon="briefcase-fill"></b-icon>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="text">
                                <h4>{{$t('ias.description_metadata')}}</h4>
                                <h6>{{$t('ias.description_matadata_con')}}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="span col-md-6 col-sm-12">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="icon">
                                <b-icon icon="book-fill"></b-icon>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="text">
                                <h4>{{$t('ias.description_discussion')}}</h4>
                                <h6>{{$t('ias.description_discussion_con')}}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="span col-md-6 col-sm-12">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="icon">
                                <b-icon icon="credit-card"></b-icon>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="text">
                                <h4>{{$t('ias.description_functions')}}</h4>
                                <h6>{{$t('ias.description_functions_con')}}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="span col-md-6 col-sm-12">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="icon">
                                <b-icon icon="calculator-fill"></b-icon>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="text">
                                <h4>{{$t('ias.description_operation')}}</h4>
                                <h6>{{$t('ias.description_operation_con')}}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
.ias_description {
    width: 100%;
    padding: 5rem 0;
}
.ias_description .span {
    display: flex;
    justify-content: space-around;
    padding: 30px 10px;
}
.ias_description .span .icon,
.ias_description .span .text {
    padding-left: 5px 0;
}
.ias_description .span .row {
    display: flex;
    align-items: center;
}
.ias_description .span .icon {
    width: 90px;
    height: 90px;
    display: table-cell;
    text-align: center;
    vertical-align: middle;
    border: 2px solid #4054B2;
    border-radius: 50%;
    color: #4054B2;
    transition: 0.3s
}
.ias_description .span .icon:hover {
    color: #fff;
    background-color: #4054B2;
    transition: 0.3s
}
.ias_description .span .icon svg {
    font-size: 2rem;
}
.ias_description .span .text h4 {
    font-weight: 500;
    text-transform: uppercase;
}
</style>