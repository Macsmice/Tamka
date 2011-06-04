{% set content = $this->row->text %}
{% set footer = 'Molajo crocodiles rock' %}
<div id="content">{% block content %}{% endblock %}</div>
  <div id="footer">
    {% block footer %}
      &copy; Copyright 2009 by <a href="http://domain.invalid/">you</a>.
    {% endblock %}
  </div>