var daterangepickerOptions = {
  locale: {
    format: "YYYY-MM-DD HH:mm:ss",
  },
  alwaysShowCalendars: true,
  timePicker: true,
  timePicker24Hour: true,
  timePickerSeconds: true,
  autoApply: true,
  alwaysShowCalendars: true,
  autoUpdateInput: true,
  ranges: {
    'Today': [
        moment().subtract(0, 'days').startOf('day'),
        moment().endOf('day')
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
