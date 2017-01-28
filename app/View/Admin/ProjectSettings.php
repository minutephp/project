<div class="content-wrapper ng-cloak" ng-app="projectEditApp" ng-controller="projectEditController as mainCtrl" ng-init="init()">
    <div class="admin-content">
        <section class="content-header">
            <h1><span translate="">Project settings</span></h1>

            <ol class="breadcrumb">
                <li><a href="" ng-href="/admin"><i class="fa fa-dashboard"></i> <span translate="">Admin</span></a></li>
                <li class="active"><i class="fa fa-edit"></i> <span translate="">Project settings</span></li>
            </ol>
        </section>

        <section class="content">
            <form name="projectForm" ng-submit="mainCtrl.save()">
                <div class="box box-{{projectForm.$valid && 'success' || 'danger'}}">
                    <div class="box-body">
                        <div class="alert alert-info alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <span translate="">Quickly create a "Projects" page for your member's by filling the form below. If you wish to use your own projects page,
                                just override the `/members/projects` route.</span>
                        </div>
                        <fieldset>
                            <legend>Configure members/projects page</legend>

                            <div class="form-group">
                                <label class="control-label" for="heading">Heading:</label>

                                <div>
                                    <input type="text" class="form-control" ng-model="settings.heading" id="heading" placeholder="My Projects" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="create">Create project:</label>

                                <div class="row">
                                    <div class="col-xs-6">
                                        <input type="text" class="form-control" ng-model="settings.createLabel" id="create" placeholder="Create project label, e.g. Create new project" />
                                    </div>
                                    <div class="col-xs-6">
                                        <input type="text" class="form-control" ng-model="settings.createLink" id="create" placeholder="Create project link, e.g. /members/create/0" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="thumbnail">Thumbnail field:</label>

                                <div>
                                    <input type="text" class="form-control" ng-model="settings.thumbnail" id="thumbnail" placeholder="%data_json.thumbnail%" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="title">Project title field:</label>

                                <div>
                                    <input type="text" class="form-control" ng-model="settings.title" id="title" placeholder="Project title field, e.g. %title% by %data_json.author|unknown%" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="updated">Project updated field:</label>

                                <div>
                                    <input type="text" class="form-control" ng-model="settings.updated" id="updated" placeholder="Project updated field, e.g. %updated_at%" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="description">Project description field:</label>

                                <div>
                                    <input type="text" class="form-control" ng-model="settings.description" id="description" placeholder="Project description field, %data_json.description%" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="fields">Links:</label>

                                <div>
                                    <div ng-repeat="link in settings.links" class="help-block">
                                        <div class="pull-right"><a href="" ng-click="settings.links.splice($index, 1)"><sup><i class="fa fa-times"></i></sup></a></div>

                                        <div class="form-inline">
                                            <input class="form-control input-sm" type="text" ng-model="link.href" ng-required="true" placeholder="Link href" />
                                            <input class="form-control input-sm" type="text" ng-model="link.label" placeholder="Link Label" />
                                            <input class="form-control input-sm" type="text" ng-model="link.hint" placeholder="Link hint" />
                                            <input class="form-control input-sm" type="text" ng-model="link.show" title="%video.vid_url%, %data_json.thumbnail%" placeholder="Show if.." />
                                            <input class="form-control input-sm" type="text" ng-model="link.icon" placeholder="Icon" />
                                            <input class="form-control input-sm" type="text" ng-model="link.class" placeholder="Class" />
                                            <a href="" ng-click="mainCtrl.makeDefault(settings.links, link, 'default')" class="text-muted">
                                                <i class="fa {{link.default && 'fa-check-circle-o' || 'fa-circle-o'}}"></i> Default
                                            </a>
                                        </div>
                                    </div>

                                    <p class="help-block">
                                        <button type="button" class="btn btn-default btn-xs" ng-click="mainCtrl.addLink();"><i class="fa fa-plus-circle"></i> Add new link</button>
                                    </p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="sorting">Sorting:</label>

                                <div>
                                    <div ng-repeat="sort in settings.sorts" class="help-block">
                                        <div class="pull-right"><a href="" ng-click="settings.sorts.splice($index, 1)"><sup><i class="fa fa-times"></i></sup></a></div>

                                        <div class="row inline-row">
                                            <div class="col-md-4">
                                                <input class="form-control input-sm" type="text" ng-model="sort.field" ng-required="true" placeholder="Field name, e.g. updated_at" />
                                            </div>
                                            <div class="col-md-4">
                                                <input class="form-control input-sm" type="text" ng-model="sort.label" ng-required="true" placeholder="Field label, e.g. Last updated at" />
                                            </div>
                                            <div class="col-md-2">
                                                <label class="checkbox-inline"><input type="checkbox" ng-model="sort.reversed"> Reversed (default)</label>
                                            </div>
                                            <div class="col-md-1 no-wrap">
                                                <a href="" ng-click="mainCtrl.makeDefault(settings.sorts, sort, 'selected')">
                                                    <i class="fa {{sort.selected && 'fa-check-circle-o' || 'fa-circle-o'}}"></i> Default
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <p class="help-block">
                                        <button type="button" class="btn btn-default btn-xs" ng-click="mainCtrl.addSort();"><i class="fa fa-plus-circle"></i> Add new sort</button>
                                    </p>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-sm-10">
                                    <hr>
                                    <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-check-circle"></i> Save changes</button>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </form>
        </section>
    </div>
</div>
