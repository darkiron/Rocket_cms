export default{

  base: 'http://localhost:8888',
  lists: [
    {
      name: 'types',
      list: '/api/types',
      crud: '/api/crud/types',
      add: '/add',
      edit: '/edit',
      delete: '/delete',
      form: [
        { name: 'title', type: 'text' },
        { name: 'type', type: 'select', values: ['content','attribute']}
      ]
    },
    {
      name: 'contents',
      list: '/api/contents',
      crud: '/api/crud/contents',
      add: '/add',
      edit: '/edit',
      delete: '/delete',
    },
    {
      name: 'attributes',
      list: '/api/attributes',
      crud: '/api/crud/attributes',
      add: '/add',
      edit: '/edit',
      delete: '/delete',
    },

  ],
  getForm(route) {
    const type = this.lists.find(item => item.name === route);
    return type.form;
  },
  getRoute(route, crud, id) {
    const type = this.lists.find(item => item.name === route);

    if (crud !== undefined && crud.length > 0) {
      if (crud === 'add') {
        return `${this.base}${type.crud}${type[crud]}`;
      }
      return `${this.base}${type.crud}${type[crud]}/${id}`;
    }

    return `${this.base}${type.list}`;
  },

};
