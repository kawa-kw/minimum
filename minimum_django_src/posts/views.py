from django.http import HttpResponse
from django.shortcuts import render

# Create your views here.

def post_create(request):
	return HttpResponse('<h1>czesc widoku create</h1>')

def post_detail(request):
	return HttpResponse('<h1>czesc widoku detail</h1>')

def post_list(request):
	# return HttpResponse('<h1>czesc widoku list</h1>')
	return render(request, 'index.html', {})

def post_update(request):
	return HttpResponse('<h1>czesc update</h1>')

def post_delete(request):
	return HttpResponse('<h1>czesc delete</h1>')