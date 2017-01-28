/// <reference path="../../../../../../../public/static/bower_components/minute/_all.d.ts" />
var Admin;
(function (Admin) {
    var ProjectEditController = (function () {
        function ProjectEditController($scope, $minute, $ui, $timeout, gettext, gettextCatalog) {
            var _this = this;
            this.$scope = $scope;
            this.$minute = $minute;
            this.$ui = $ui;
            this.$timeout = $timeout;
            this.gettext = gettext;
            this.gettextCatalog = gettextCatalog;
            this.addLink = function (href, label, icon) {
                _this.$scope.settings.links.push({ href: href, label: label, icon: 'fa ', 'class': 'btn-default' });
            };
            this.addSort = function (href, label, icon) {
                _this.$scope.settings.sorts.push({ field: '', label: '', reversed: false });
            };
            this.makeDefault = function (links, link, key) {
                angular.forEach(links, function (v) {
                    v[key] = link == v && !v[key];
                });
            };
            this.save = function () {
                _this.$scope.config.save(_this.gettext('Project saved successfully'));
            };
            gettextCatalog.setCurrentLanguage($scope.session.lang || 'en');
            var loadSample = !$scope.configs[0];
            $scope.config = $scope.configs[0] || $scope.configs.create().attr('type', 'project').attr('data_json', {});
            $scope.settings = $scope.config.attr('data_json');
            if (loadSample) {
                var sample = {
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
        return ProjectEditController;
    }());
    Admin.ProjectEditController = ProjectEditController;
    angular.module('projectEditApp', ['MinuteFramework', 'AdminApp', 'gettext'])
        .controller('projectEditController', ['$scope', '$minute', '$ui', '$timeout', 'gettext', 'gettextCatalog', ProjectEditController]);
})(Admin || (Admin = {}));
