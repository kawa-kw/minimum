from django.contrib import messages
from django.core.paginator import Paginator, EmptyPage, PageNotAnInteger
from django.shortcuts import render
from django.http import HttpResponse, HttpResponseRedirect
from django.shortcuts import render, get_object_or_404, redirect

from .forms import PostForm
from .models import Post

def post_create(request):
	form = PostForm(request.POST or None, request.FILES or None)
	if form.is_valid():
		instance = form.save(commit=False)
		instance.save()
		# message success
		messages.success(request, 'Post stworzony')
		return HttpResponseRedirect(instance.get_absolute_url())
	# else:
	# 	messages.error(request, 'Nie udalo sie stworzyc posta')

	# if request.method == 'POST':
	# 	print request.POST.get('content')
	# 	print request.POST.get('title')
	context = {
		'form': form,
	}
	return render(request, 'post_form.html', context)

def post_detail(request, id=None):
	instance = get_object_or_404(Post, id=id)
	context = {
		'title':instance.title,
		'instance': instance,
	}
	return render(request, 'post_detail.html', context)

def post_list(request):
	# Pierwszy sposob:
	# return HttpResponse('<h1>czesc widoku list</h1>')

	# Drugi sposob
	# w context podajemy zmienne, po ktorych mozemy odwolac sie w templatkach, wpisujac tylko np. {{ title }}
	# to ponizej jest OK, korzystamy jendak z query set
	# if request.user.is_authenticated():
	# 	context = {
	# 		'title': 'List dla zalogowanego'
	# 	}
	# 	return render(request, 'index.html', context)
	# else:
	# 	context = {
	# 		'title': 'List dla NIEzalogowanego'
	# 	}
	# 	return render(request, 'index-not-logged.html', context)

	# Trzeci sposob
	queryset_list = Post.objects.all() #.order_by('-timestamp')
	paginator = Paginator(queryset_list, 10) # Show 25 contacts per page
	page_request_var = "strona"
	page = request.GET.get(page_request_var)
	try:
		queryset = paginator.page(page)
	except PageNotAnInteger:
		# If page is not an integer, deliver first page.
		queryset = paginator.page(1)
	except EmptyPage:
		# If page is out of range (e.g. 9999), deliver last page of results.
		queryset = paginator.page(paginator.num_pages)

	context = {
		'object_list': queryset,
		'title':'List',
		'page_request_var': page_request_var
	}
	return render(request, 'post_list.html', context)

def post_update(request, id=None):
	instance = get_object_or_404(Post, id=id)
	form = PostForm(request.POST or None, request.FILES or None, instance=instance)
	if form.is_valid():
		instance = form.save(commit=False)
		instance.save()
		# message succes
		messages.success(request, 'Post edytowany - zapisany')
		return HttpResponseRedirect(instance.get_absolute_url())

	context = {
		'title': instance.title,
		'instance': instance,
		'form': form,
	}
	return render(request, 'post_form.html', context)

def post_delete(request, id=None):
	instance = get_object_or_404(Post, id=id)
	instance.delete()
	messages.success(request, 'Post usuniety')
	return redirect('posts:list')
