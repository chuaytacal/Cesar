#include <iostream>

using namespace std;

int main(){
	int A[100];
	int aux, cen = 0, x = 1;
    int n;
    int izq, der, k, m;
    int menor;
    cout << "Ingrese la cantidad de numeros del arreglo: ";
    cin >> n;
    for(int i = 0; i < n; i++){
        cin >> A[i];
        cout << endl;
    }
    //INTERCAMBIO DIRECTO POR LA DERECHA
    for(int i = 1; i < n; i++){
	    for(int j = 0; j < n-i; j++){
	    	if(A[j] > A[j+1]){
	    		aux = A[j];
	    		A[j] = A[j+1];
	    		A[j+1] = aux;
			}
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
    //INTERCAMBIO DIRECTO POR LA IZQUIERDA
	for(int i = 1; i < n; i++){
	    for(int j = n-1; j >= i; j--){
	    	if(A[j] < A[j-1]){
	    		aux = A[j-1];
	    		A[j-1] = A[j];
	    		A[j] = aux;
			}
		}
	}
    //INTERCAMBIO DIRECTO CON SEÑAL
    while(x < n && cen == 0){
    	cen = 1;
    	for(int j = 0; j < n-x; j++){
	    	if(A[j] > A[j+1]){
				aux = A[j];
	    		A[j] = A[j+1];
	    		A[j+1] = aux;
	    		cen = 0;
	    	}
		}
		x++;
	}
	//INTERCAMBIO DIRECTO BIDIRECCIONAL
	izq = 1;
	der = n;
	k = n;
	while(izq <= der){
		for(int i = der; i >= izq; i--){
			if(A[i-1] > A[i]){
				aux = A[i-1];
				A[i-1] = A[i];
				A[i] = aux;
				k = i;
			}
		}
		izq = k + 1;
		for(int i = izq; i <= der; i++){
			if(A[i-1] > A[i]){
				aux = A[i-1];
				A[i-1] = A[i];
				A[i] = aux;
				k = i;
			}
		}
		der = k - 1;
	}
	//SELECCIÓN DIRECTA
	for(int i = 0; i < n-1; i++){
		menor = A[i];
		k = i;
		for(int j = i+1; j < n; j++){
			if(A[j] < menor){
				menor = A[j];
				k = j;
			}
		}
		A[k] = A[i];
		A[i] = menor; 
	}
	//INSERCCIÓN DIRECTA
	for(int i = 1; i < n; i++){
		aux = A[i];
		k = i - 1;
		while(k > -1 && aux < A[k]){
			A[k+1] = A[k];
			k--;
		}
		A[k+1] = aux;
	}

	//INSERCCIÓN BINARIA
	int j;
    for(int i = 1; i < n; i++){
    	aux = A[i];
		izq = 0;
    	der = i - 1;
    	while(izq <= der){
    		m = (izq+der)/2;
    		if(A[m] > A[i]){
    			der = m - 1;
			}
			else{
				izq = m + 1;
			}
		}
		j = i - 1;
		while(j >= izq){
			A[j+1] = A[j];
			j--;
		}
		A[izq] = aux;
	}
	
	//Método de Shell (int x = int i)
    k = n + 1;
    while(k > 0){
    	k = k/2;
    	cen = 1;
    	while(cen == 1){
    		cen = 0;
    		x = 0;
    		while((x+k) < n){
    			if(A[x+k] < A[x]){
    				aux = A[x];
    				A[x] = A[x+k];
    				A[x+k] = aux;
    				cen = 1;
				}
				x++;
			}
		}
	}
	
	//Método rápido o quicksort
	quicksort(A, 0, n-1);
	
    for(int i = 0; i < n; i++){
    	cout << A[i] << endl;
	}
	return 0;
}

void quicksort(int A[], int izq, int der);
// MÉTODO RÁPIDO O QUICKSORT
void quicksort(int A[], int izq, int der)
{ 
	int i, j, x, aux; 
	i = izq; 
	j = der; 
	x = A[(izq + der)/2]; 
    do{ 
        while((A[i] < x) && (j <= der))
        { 
            i++;
        } 
 
        while((x < A[j]) && (j > izq))
        { 
            j--;
        } 
 
        if(i <= j)
        { 
            aux = A[i]; 
			A[i] = A[j]; 
			A[j] = aux; 
            i++;  j--;
        }
         
    }while(i <= j); 
 
    if(izq < j) 
        quicksort(A, izq, j); 
    if(i < der) 
        quicksort(A, i, der); 
}

int busquedaDesordenada(int A[], int n, int dato){
	int i, pos = 0;
	i = 0;
	while(i < n && A[i] != dato){
		i++;
	}
	if(i < n){
		pos = i;
	}
	return pos;
}

int busquedaOrdenada(int A[], int n, int dato){
	int i = 0, pos = 0;
	while(i < n && A[i] < dato){
		i++;
	}
	if(i > n || A[i] > dato){
		pos = -i;
	}
	else{
		pos = i;
	}
	return pos;
}