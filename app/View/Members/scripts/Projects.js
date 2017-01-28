/// <reference path="../../../../../../../public/static/bower_components/minute/_all.d.ts" />
var Admin;
(function (Admin) {
    var ProjectListController = (function () {
        function ProjectListController($scope, $minute, $ui, $timeout, $filter, gettext, gettextCatalog) {
            var _this = this;
            this.$scope = $scope;
            this.$minute = $minute;
            this.$ui = $ui;
            this.$timeout = $timeout;
            this.$filter = $filter;
            this.gettext = gettext;
            this.gettextCatalog = gettextCatalog;
            this.actions = function (item) {
                var gettext = _this.gettext;
                var data = item.getAttributes();
                var replace = function (value) { return _this.$filter('replaceTags')(value, data); };
                var actions = [];
                var settings = _this.$scope.settings;
                for (var _i = 0, _a = settings.links; _i < _a.length; _i++) {
                    var link = _a[_i];
                    var action = /\(/.test(link.href) ? { click: link.href } : { href: replace(link.href) };
                    actions.push(angular.extend({ 'text': gettext(replace(link.label)), 'icon': link.icon, 'show': link.show, 'hint': gettext(replace(link.hint)) }, action));
                }
                _this.$ui.bottomSheet(actions, gettext('Actions for: ') + replace(settings.title), _this.$scope, { item: item, ctrl: _this });
            };
            this.clone = function (project) {
                var gettext = _this.gettext;
                _this.$ui.prompt(gettext('Enter new slug'), gettext('/new-slug')).then(function (slug) {
                    project.clone().attr('slug', slug).save(gettext('Project duplicated')).then(function (copy) {
                        angular.forEach(project.contents, function (content) { return copy.item.contents.cloneItem(content).save(); });
                    });
                });
            };
            gettextCatalog.setCurrentLanguage($scope.session.lang || 'en');
            $scope.settings = $scope.configs[0] ? $scope.configs[0].attr('data_json') : {};
        }
        return ProjectListController;
    }());
    Admin.ProjectListController = ProjectListController;
    angular.module('projectListApp', ['MinuteFramework', 'MembersApp', 'gettext', 'AngularDynamicHtml'])
        .controller('projectListController', ['$scope', '$minute', '$ui', '$timeout', '$filter', 'gettext', 'gettextCatalog', ProjectListController]);
})(Admin || (Admin = {}));
