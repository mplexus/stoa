var daterangepickerOptions = {
  startDate: moment().startOf('month'),
  endDate: moment().endOf('month'),
  locale: {
    format: 'YYYY-MM-DD'
  },
  alwaysShowCalendars: true,
  autoApply: true,
  ranges: {
    'Today': [
        moment().subtract(0, 'days'),
        moment()
    ],
    'This Month': [
        moment().startOf('month'),
        moment().endOf('month')
    ],
    'Previous month': [
        moment().startOf('month').subtract(1, 'months'),
        moment().subtract(1, 'months').endOf('month')
    ],
    'This year': [
        moment().startOf('year'),
        moment().endOf('year')
    ]
  }
};
