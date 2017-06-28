from django.conf.urls import url
from django.contrib import admin

from .views import (
    post_list,
    post_create,
    post_detail,
    post_update,
    post_delete
)

urlpatterns = [
    url(r'^$', post_list, name='list'),
    url(r'^create/$', post_create),
    #url(r'^detail/(?P<id>\d+)/$', post_detail),
    url(r'^(?P<slug>.+)/$', post_detail, name='detail'),
    url(r'^(?P<slug>.+)/edit/$', post_update, name='update'),
    url(r'^(?P<slug>.+)/delete/$', post_delete),
]
