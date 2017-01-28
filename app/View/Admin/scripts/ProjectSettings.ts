/// <reference path="../../../../../../../public/static/bower_components/minute/_all.d.ts" />

module Admin {
    export class ProjectEditController {
        constructor(public $scope: any, public $minute: any, public $ui: any, public $timeout: ng.ITimeoutService,
                    public gettext: angular.gettext.gettextFunction, public gettextCatalog: angular.gettext.gettextCatalog) {

            gettextCatalog.setCurrentLanguage($scope.session.lang || 'en');

            let loadSample = !$scope.configs[0];
            $scope.config = $scope.configs[0] || $scope.configs.create().attr('type', 'project').attr('data_json', {});
            $scope.settings = $scope.config.attr('data_json');

            if (loadSample) {
                let sample = {
                    "links": [
                        {
                            "href": "../videos/%title_slug%",
                            "icon": "fa fa-edit",
                            "class": "",
                            "label": "Edit",
                            "hint": "Edit video",
                            "default": true
                        },
                        {
                            "href": "/members/wizard/%project_id%",
                            "label": "View",
                            "icon": "fa fa-eye",
                            "class": "",
                            "hint": "View video"
                        },
                        {
                            "href": "item.remove()",
                            "label": "Remove",
                            "icon": "fa fa-trash",
                            "class": "",
                            "hint": "Delete project"
                        },
                        {
                            "href": "item.attr('public', false).save(true)",
                            "label": "Set private",
                            "icon": "fa fa-lock",
                            "class": "",
                            "hint": "Make private",
                            "show": "item.public"
                        },
                        {
                            "href": "item.attr('public', true).save(true)",
                            "label": "Set public",
                            "icon": "fa fa-unlock",
                            "class": "",
                            "hint": "Mark public",
                            "show": "!item.public"
                        }
                    ],
                    "sorts": [
                        {
                            "field": "updated_at",
                            "label": "Last updated at",
                            "reversed": true,
                            "selected": true
                        },
                        {
                            "field": "title",
                            "label": "Project name",
                            "reversed": false,
                            "selected": false
                        }
                    ],
                    "heading": "My projects",
                    "title": "%title% <small ng-show=\"'%data_json.keyword%'\">for keyword %data_json.keyword%</small>",
                    "thumbnail": "%data_json.thumbnail%",
                    "updated": "%updated_at%",
                    "description": "<span ng-show=\"'%data_json.list.0.name%'\">%data_json.list.0.name%</span><span ng-show=\"'%data_json.list.1.name%'\">, %data_json.list.1.name%</span><span ng-show=\"'%data_json.list.2.name%'\">, %data_json.list.2.name%</span>",
                    "createLabel": "Create new project",
                    "createLink": "/create"
                };

                angular.extend($scope.settings, sample);
            }

            $scope.settings.links = angular.isArray($scope.settings.links) ? $scope.settings.links : [{}];
            $scope.settings.sorts = angular.isArray($scope.settings.sorts) ? $scope.settings.sorts : [{}];
        }

        addLink = (href, label, icon) => {
            this.$scope.settings.links.push({href: href, label: label, icon: 'fa ', 'class': 'btn-default'});
        };

        addSort = (href, label, icon) => {
            this.$scope.settings.sorts.push({field: '', label: '', reversed: false});
        };

        makeDefault = (links, link, key) => {
            angular.forEach(links, function (v) {
                v[key] = link == v && !v[key];
            });
        };

        save = () => {
            this.$scope.config.save(this.gettext('Project saved successfully'));
        };
    }

    angular.module('projectEditApp', ['MinuteFramework', 'AdminApp', 'gettext'])
        .controller('projectEditController', ['$scope', '$minute', '$ui', '$timeout', 'gettext', 'gettextCatalog', ProjectEditController]);
}
