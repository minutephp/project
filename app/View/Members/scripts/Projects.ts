/// <reference path="../../../../../../../public/static/bower_components/minute/_all.d.ts" />

module Admin {
    export class ProjectListController {
        constructor(public $scope:any, public $minute:any, public $ui:any, public $timeout:ng.ITimeoutService, public $filter:any,
                    public gettext:angular.gettext.gettextFunction, public gettextCatalog:angular.gettext.gettextCatalog) {

            gettextCatalog.setCurrentLanguage($scope.session.lang || 'en');
            $scope.settings = $scope.configs[0] ? $scope.configs[0].attr('data_json') : {};
        }

        actions = (item) => {
            let gettext = this.gettext;
            let data = item.getAttributes();
            let replace:any = (value) => this.$filter('replaceTags')(value, data);
            let actions = [];
            let settings = this.$scope.settings;

            for (let link of settings.links) {
                let action = /\(/.test(link.href) ? {click: link.href} : {href: replace(link.href)};
                actions.push(angular.extend({'text': gettext(replace(link.label)), 'icon': link.icon, 'show': link.show, 'hint': gettext(replace(link.hint))}, action));
            }

            this.$ui.bottomSheet(actions, gettext('Actions for: ') + replace(settings.title), this.$scope, {item: item, ctrl: this});
        };

        clone = (project) => {
            let gettext = this.gettext;
            this.$ui.prompt(gettext('Enter new slug'), gettext('/new-slug')).then(function (slug) {
                project.clone().attr('slug', slug).save(gettext('Project duplicated')).then(function (copy) {
                    angular.forEach(project.contents, (content) => copy.item.contents.cloneItem(content).save());
                });
            });
        }
    }

    angular.module('projectListApp', ['MinuteFramework', 'MembersApp', 'gettext', 'AngularDynamicHtml'])
        .controller('projectListController', ['$scope', '$minute', '$ui', '$timeout', '$filter', 'gettext', 'gettextCatalog', ProjectListController]);
}
