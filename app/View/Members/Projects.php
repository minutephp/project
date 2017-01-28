<div class="content-wrapper ng-cloak" ng-app="projectListApp" ng-controller="projectListController as mainCtrl" ng-init="init()">
    <div class="members-content">
        <section class="content-header">
            <h1>
                <span ng-bind-html="(settings.page.title || ('List of projects' | translate)) | replaceTags | safe"></span>
            </h1>

            <ol class="breadcrumb">
                <li><a href="" ng-href="/members"><i class="fa fa-dashboard"></i> <span translate="">Members</span></a></li>
                <li class="active"><i class="fa fa-project"></i> <span ng-bind-html="(settings.page.title || 'List of projects') | replaceTags | safe"></span></li>
            </ol>
        </section>

        <section class="content">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span ng-bind-html="(settings.list.heading || '<i class=\'fa fa-folder-open-o\'></i> ' + ('My Projects' | translate)) | replaceTags | safe"></span>
                    </h3>

                    <div class="box-tools">
                        <a class="btn btn-sm btn-success btn-flat" ng-href="{{settings.createLink}}">
                            <i class="fa fa-plus-circle"></i>
                            <span ng-bind-html="(settings.createLabel || ( 'Create new project' | translate)) | safe"></span>
                        </a>
                    </div>
                </div>

                <div class="box-body">
                    <div ng-show="!projects.length">
                        <span translate="">You haven't created any projects yet.</span>
                        <hr>
                        <a class="btn btn-primary text-uppercase text-bold" ng-href="{{settings.createLink}}">
                            <i class="fa fa-plus-circle"></i> <span ng-bind-html="(settings.create || ('Create new project' | translate)) | safe"></span>
                        </a>
                    </div>

                    <div class="list-group" ng-show="!!projects.length">
                        <div class="list-group-item list-group-item-bar list-group-item-bar-{{project.public && 'success' || 'info'}}"
                             ng-repeat="project in projects" ng-click-container="mainCtrl.actions(project)" ng-init="data = project.getAttributes()">

                            <div class="row">
                                <div class="col-xs-9">
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="#">
                                                <img style="max-height:120px;" src="" ng-src="{{(settings.thumbnail  | replaceTags:data) || '/static/local/assets/images/no-thumbnail.jpg'}}">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading text-bold">
                                                <span dynamic-html="(settings.title || 'Untitled') | replaceTags:data | ucfirst"></span>
                                            </h4>
                                            <p class="hidden-xs" ng-show="settings.updated">
                                                <span translate="">Last updated </span> {{settings.updated | replaceTags:data | timeAgoStr}}.
                                            </p>
                                            <p class="hidden-xs" dynamic-html="settings.description | replaceTags:data"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <div class="pull-right-gt-sm">
                                        <a href="" ng-repeat="link in settings.links" ng-if="link.default" ng-href="{{link.href | replaceTags:data}}"
                                           class="{{link.class || 'btn btn-sm btn-flat btn-primary'}}">
                                            <i class="{{link.icon}}" tooltip="{{link.hint}}" ng-click="splLink(link, project, $event)"></i> {{link.label | replaceTags:data | truncate:35}}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="box-footer" ng-show="!!projects.length">
                    <div class="row">
                        <div class="col-sm-5 col-sm-push-7">
                            <minute-pager class="pull-right-gt-sm" on="projects" no-results="{{'No projects found' | translate}}"></minute-pager>
                        </div>
                        <div class="col-sm-4 col-sm-pull-5">
                            <minute-search-bar on="projects" columns="title, data_json" label="{{'Search projects..' | translate}}"></minute-search-bar>
                        </div>
                        <div class="col-sm-3 col-sm-pull-5">
                            <minute-sort-bar on="projects" columns="[{field:'updated_at', label:'Last updated at'}, {field:'title', label:'Project name'}]"></minute-sort-bar>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>