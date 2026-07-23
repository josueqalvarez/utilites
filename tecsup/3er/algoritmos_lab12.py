
class Nodo():
    def __init__(self, valor):
        self.valor = valor
        self.izquierda = None
        self.derecha = None

class Arbol():
    def __init__(self):
        self.raiz = None

    def insertar(self, valor):
        if self.raiz is None:
            self.raiz = Nodo(valor)
        else:
            self._insertar_recursivo(self.raiz, valor)

    def _insertar_recursivo(self, base, valor):
        if valor < base.valor:
            if base.izquierda is None:
                base.izquierda = Nodo(valor)
                return
            else:
                self._insertar_recursivo(base.izquierda, valor)
        if valor > base.valor:
            if base.derecha is None:
                base.derecha = Nodo(valor)
                return
            else:
                self._insertar_recursivo(base.derecha, valor)

    def mostrar2(self):
        if self.raiz is None:
            print("(arbol vacio)")
            return

        def _altura(nodo):
            if nodo is None:
                return 0
            return 1 + max(_altura(nodo.izquierda), _altura(nodo.derecha))

        altura = _altura(self.raiz)
        ancho_valor = max(len(str(n.valor)) for n in self._nodos_preorden(self.raiz))
        celda = max(2, ancho_valor) + 1
        filas = altura * 2 - 1
        columnas_unidades = (2 ** altura) + 1
        columnas = columnas_unidades * celda
        lienzo = [[" "] * columnas for _ in range(filas)]

        def _dibujar(nodo, nivel, pos, salto):
            if nodo is None:
                return

            fila = nivel * 2
            texto = str(nodo.valor)
            centro = pos * celda
            inicio = max(0, centro - (len(texto) // 2))
            for i, ch in enumerate(texto):
                if inicio + i < columnas:
                    lienzo[fila][inicio + i] = ch

            if nivel < altura - 1 and fila + 1 < filas:
                if nodo.izquierda is not None and centro - 1 >= 0:
                    lienzo[fila + 1][centro - 1] = "/"
                if nodo.derecha is not None and centro + 1 < columnas:
                    lienzo[fila + 1][centro + 1] = "\\"

            siguiente_salto = max(1, salto // 2)
            if nodo.izquierda is not None:
                _dibujar(nodo.izquierda, nivel + 1, pos - salto, siguiente_salto)
            if nodo.derecha is not None:
                _dibujar(nodo.derecha, nivel + 1, pos + salto, siguiente_salto)

        posicion_raiz = 2 ** (altura - 1)
        salto_inicial = 2 ** (altura - 2) if altura > 1 else 0
        _dibujar(self.raiz, 0, posicion_raiz, salto_inicial)

        for fila in lienzo:
            print("".join(fila).rstrip())

    def _nodos_preorden(self, nodo):
        if nodo is None:
            return []
        return [nodo] + self._nodos_preorden(nodo.izquierda) + self._nodos_preorden(nodo.derecha)

    def mostrar(self, nodo_actual=None, count=1):
        if nodo_actual is None:
            nodo_actual = self.raiz

        if nodo_actual is None:
            print("(arbol vacio)")
            return
        else:
            if nodo_actual.izquierda is not None:
                self.mostrar(nodo_actual.izquierda, count=count+1)
            
            for n in range(count):
                # Par
                if count % 2 == 0:
                    print(" ", end="")
                    print(nodo_actual.valor, end="")
                # Impar
                elif n == ((count / 2) - 0.5):
                    print(nodo_actual.valor, end="")
                else:
                    print(" ", end="")
            
            print(nodo_actual.valor)
            if nodo_actual.derecha is not None:
                self.mostrar(nodo_actual.derecha, count=count+1)

nuevo = Arbol()
nuevo.insertar(5)
nuevo.insertar(3)
nuevo.insertar(7)
nuevo.insertar(2)
nuevo.insertar(4)

nuevo.mostrar()