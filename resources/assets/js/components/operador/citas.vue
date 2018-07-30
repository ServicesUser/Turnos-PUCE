<template>
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-share font-dark hide"></i>
                <span class="caption-subject font-dark bold uppercase">Turnos Asignados</span>
            </div>
            <div class="actions">
                <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;" title="Actualizar" data-original-title="Actualizar">
                    <i class="fa fa-refresh"></i>
                </a>
                <a class="btn btn-circle btn-icon-only btn-default fullscreen" data-container="false" data-placement="bottom" href="javascript:;" data-original-title="Pantalla completa" title="Pantalla completa"> </a>
            </div>
        </div>
        <div class="portlet-body">
            <div class="mt-element-list">
                <div class="mt-list-head list-default bg-primary">
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="list-head-title-container">
                                <h3 class="list-title uppercase sbold">Estudiantes</h3>
                                <div class="list-date">{{actual}}</div>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="list-head-summary-container">
                                <div class="list-pending">
                                    <div class="badge badge-default list-count">3</div>
                                    <div class="list-label">Pendientes</div>
                                </div>
                                <div class="list-done">
                                    <div class="list-count badge badge-default last">2</div>
                                    <div class="list-label">Completos</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-list-container list-default">
                    <ul>
                        <li class="mt-list-item">
                            <div class="list-icon-container done">
                                <a href="javascript:;">
                                    <i class="icon-check"></i>
                                </a>
                            </div>
                            <div class="list-datetime"> 11am
                                <br> 8 Nov </div>
                            <div class="list-item-content">
                                <h3 class="uppercase bold">
                                    <a href="javascript:;">Concept Proof</a>
                                </h3>
                                <p>Lorem ipsum dolor sit amet</p>
                            </div>
                        </li>
                        <li class="mt-list-item">
                            <div class="list-icon-container">
                                <a href="javascript:;">
                                    <i class="icon-close"></i>
                                </a>
                            </div>
                            <div class="list-datetime"> 11am
                                <br> 8 Nov </div>
                            <div class="list-item-content">
                                <h3 class="uppercase bold">
                                    <a href="javascript:;">Listings Feature</a>
                                </h3>
                                <p>Lorem ipsum dolor sit amet</p>
                            </div>
                        </li>
                        <li class="mt-list-item">
                            <div class="list-icon-container">
                                <a href="javascript:;">
                                    <i class="icon-close"></i>
                                </a>
                            </div>
                            <div class="list-datetime"> 11am
                                <br> 8 Nov </div>
                            <div class="list-item-content">
                                <h3 class="uppercase bold">
                                    <a href="javascript:;">Listings Feature</a>
                                </h3>
                                <p>Lorem ipsum dolor sit amet</p>
                            </div>
                        </li>
                        <li class="mt-list-item">
                            <div class="list-icon-container done">
                                <a href="javascript:;">
                                    <i class="icon-check"></i>
                                </a>
                            </div>
                            <div class="list-datetime"> 11am
                                <br> 8 Nov </div>
                            <div class="list-item-content">
                                <h3 class="uppercase bold">
                                    <a href="javascript:;">Listings Feature</a>
                                </h3>
                                <p>Lorem ipsum dolor sit amet</p>
                            </div>
                        </li>
                        <li class="mt-list-item">
                            <div class="list-icon-container">
                                <a href="javascript:;">
                                    <i class="icon-close"></i>
                                </a>
                            </div>
                            <div class="list-datetime"> 11am
                                <br> 8 Nov </div>
                            <div class="list-item-content">
                                <h3 class="uppercase bold">
                                    <a href="javascript:;">Listings Feature</a>
                                </h3>
                                <p>Lorem ipsum dolor sit amet</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "citas",
        data: () => ({
            cargado:false,
            actual:'',
        }),
        computed:{

        },
        methods:{
            time:function() {
                let self = this;
                this.actual = moment().format('dddd Do MMMM YYYY, HH:mm:ss');
                setTimeout(self.time, 1000);
            },
        },
        mounted(){
            this.time();
        }
    }
</script>

<style scoped>

</style>